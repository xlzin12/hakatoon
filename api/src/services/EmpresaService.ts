import { hash } from "bcryptjs"
import { AppError } from "../utils/AppError"
import { EmpresaRepository } from "../repositories/EmpresaRepository"
import { Empresa } from "../entities/Empresa"


type EmpresaInput = Partial<Empresa> & { senha?: string }

export class EmpresaService {
  private empresaRepository: EmpresaRepository

  constructor() {
    this.empresaRepository = new EmpresaRepository()
  }

  async criarEmpresa(dados: EmpresaInput): Promise<Empresa> {
    if (!dados.cnpj || !dados.nomeFantasia || !dados.razaoSocial || !dados.emailCoportaivo) {
      throw new AppError("Dados obrigatórios da empresa ausentes", 400)
    }

    const empresaExistente = await this.empresaRepository.findByEmail(dados.emailCoportaivo)
    if (empresaExistente) {
      throw new AppError("Empresa com este email corporativo já existe", 409)
    }

    const senhaHash = dados.senha
      ? await hash(dados.senha, 10)
      : dados.senhaHash || ""

    if (!senhaHash) {
      throw new AppError("Senha da empresa é obrigatória", 400)
    }

    const empresaCriada = await this.empresaRepository.create({
      ...dados,
      senhaHash,
      statusAprovacao: dados.statusAprovacao ?? "PENDENTE",
    })

    return empresaCriada
  }

  async buscarEmpresaPorId(id: string): Promise<Empresa> {
    const empresa = await this.empresaRepository.findById(id)
    if (!empresa) {
      throw new AppError("Empresa não encontrada", 404)
    }
    return empresa
  }

  async listarEmpresas(status?: Empresa["statusAprovacao"]): Promise<Empresa[]> {
    const empresas = await this.empresaRepository.findAll()
    if (!status) {
      return empresas
    }
    return empresas.filter((empresa) => empresa.statusAprovacao === status)
  }

  async atualizarEmpresa(id: string, dados: EmpresaInput): Promise<Empresa> {
    const empresa = await this.buscarEmpresaPorId(id)

    if (dados.emailCoportaivo && dados.emailCoportaivo !== empresa.emailCoportaivo) {
      const emailExistente = await this.empresaRepository.findByEmail(dados.emailCoportaivo)
      if (emailExistente && emailExistente.id !== id) {
        throw new AppError("Outro empresa já usa este email corporativo", 409)
      }
    }

    const atualizacao: Partial<Empresa> = { ...dados }
    if (dados.senha) {
      atualizacao.senhaHash = await hash(dados.senha, 10)
    }
    delete (atualizacao as any).senha

    return this.empresaRepository.update(id, atualizacao)
  }

  async deletarEmpresa(id: string): Promise<void> {
    await this.buscarEmpresaPorId(id)
    await this.empresaRepository.delete(id)
  }

  async aprovarEmpresa(id: string): Promise<Empresa> {
    await this.buscarEmpresaPorId(id)
    return this.empresaRepository.update(id, { statusAprovacao: "APROVADO" })
  }

  async bloquearEmpresa(id: string): Promise<Empresa> {
    await this.buscarEmpresaPorId(id)
    return this.empresaRepository.update(id, { statusAprovacao: "BLOQUEADO" })
  }
  

  
}
