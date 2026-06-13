import { AppError } from "../utils/AppError"
import { VagaRepository } from "../repositories/VagaRepository"
import { EmpresaRepository } from "../repositories/EmpresaRepository"
import { Vaga } from "../entities/Vaga"

type VagaInput = Partial<Vaga> & { empresaId: string }

export class VagaService {
  private vagaRepository: VagaRepository
  private empresaRepository: EmpresaRepository

  constructor() {
    this.vagaRepository = new VagaRepository()
    this.empresaRepository = new EmpresaRepository()
  }

  async criarVaga(dados: VagaInput): Promise<Vaga> {
    if (!dados.titulo || !dados.descricao || !dados.requisitos || !dados.empresaId) {
      throw new AppError("Dados obrigatórios da vaga ausentes", 400)
    }

    const empresa = await this.empresaRepository.findById(dados.empresaId)
    if (!empresa) {
      throw new AppError("Empresa não encontrada para esta vaga", 404)
    }

    const vagaData: Partial<Vaga> = {
      titulo: dados.titulo,
      descricao: dados.descricao,
      requisitos: dados.requisitos,
      ativa: dados.ativa ?? true,
      empresa: { id: dados.empresaId } as any,
    }

    if (dados.beneficios !== undefined) {
      vagaData.beneficios = dados.beneficios
    }

    if (dados.cargaHoraria !== undefined) {
      vagaData.cargaHoraria = dados.cargaHoraria
    }

    if (dados.localizacao !== undefined) {
      vagaData.localizacao = dados.localizacao
    }

    const vagaCriada = await this.vagaRepository.create(vagaData)

    return vagaCriada
  }

  async buscarVagaPorId(id: string): Promise<Vaga> {
    const vaga = await this.vagaRepository.findById(id)
    if (!vaga) {
      throw new AppError("Vaga não encontrada", 404)
    }
    return vaga
  }

  async listarVagas(): Promise<Vaga[]> {
    return this.vagaRepository.findAll()
  }

  async atualizarVaga(id: string, dados: Partial<Vaga>): Promise<Vaga> {
    await this.buscarVagaPorId(id)

    if (dados.empresa && dados.empresa.id) {
      const empresa = await this.empresaRepository.findById(dados.empresa.id)
      if (!empresa) {
        throw new AppError("Empresa para a vaga não encontrada", 404)
      }
    }

    return this.vagaRepository.update(id, dados)
  }

  async deletarVaga(id: string): Promise<void> {
    await this.buscarVagaPorId(id)
    await this.vagaRepository.delete(id)
  }

  async listarVagasPorEmpresa(empresaId: string): Promise<Vaga[]> {
    await this.empresaRepository.findById(empresaId)
    return this.vagaRepository.findByEmpresa(empresaId)
  }

  async listarVagasAbertas(): Promise<Vaga[]> {
    return this.vagaRepository.findAbertas()
  }

  async fecharVaga(id: string): Promise<Vaga> {
    await this.buscarVagaPorId(id)
    return this.vagaRepository.update(id, { ativa: false })
  }
}
