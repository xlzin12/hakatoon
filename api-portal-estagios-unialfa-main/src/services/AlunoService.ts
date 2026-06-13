import { hash } from "bcryptjs"
import { AppError } from "../utils/AppError"
import { AlunoRepository } from "../repositories/AlunoRepository"
import { Aluno } from "../entities/Aluno"

export class AlunoService {
  private alunoRepository: AlunoRepository

  constructor() {
    this.alunoRepository = new AlunoRepository()
  }

  async criarAluno(dados: Partial<Aluno>): Promise<Aluno> {
    if (!dados.emailAcademico || !dados.ra || !dados.senha || !dados.nome) {
      throw new AppError("Dados obrigatórios ausentes", 400)
    }

    const alunoExistente = await this.alunoRepository.findByEmail(dados.emailAcademico)
    if (alunoExistente) {
      throw new AppError("Aluno com este email acadêmico já existe", 409)
    }

    const raExistente = await this.alunoRepository.findByRa(dados.ra)
    if (raExistente) {
      throw new AppError("Aluno com este RA já existe", 409)
    }

    const senhaHash = await hash(dados.senha, 10)
    const alunoCriado = await this.alunoRepository.create({
      ...dados,
      senha: senhaHash,
      primeiroAcesso: dados.primeiroAcesso ?? true,
      statusAptoEstagio: dados.statusAptoEstagio ?? false,
    })

    return alunoCriado
  }

  async buscarAlunoPorId(id: string): Promise<Aluno> {
    const aluno = await this.alunoRepository.findById(id)
    if (!aluno) {
      throw new AppError("Aluno não encontrado", 404)
    }
    return aluno
  }

  async listarAlunos(): Promise<Aluno[]> {
    return this.alunoRepository.findAll()
  }

  async atualizarAluno(id: string, dados: Partial<Aluno>): Promise<Aluno> {
    const aluno = await this.buscarAlunoPorId(id)

    if (dados.emailAcademico && dados.emailAcademico !== aluno.emailAcademico) {
      const alunoComMesmoEmail = await this.alunoRepository.findByEmail(dados.emailAcademico)
      if (alunoComMesmoEmail && alunoComMesmoEmail.id !== id) {
        throw new AppError("Outro aluno já usa este email acadêmico", 409)
      }
    }

    if (dados.ra && dados.ra !== aluno.ra) {
      const alunoComMesmoRa = await this.alunoRepository.findByRa(dados.ra)
      if (alunoComMesmoRa && alunoComMesmoRa.id !== id) {
        throw new AppError("Outro aluno já usa este RA", 409)
      }
    }

    if (dados.senha) {
      dados.senha = await hash(dados.senha, 10)
    }

    return this.alunoRepository.update(id, dados)
  }

  async deletarAluno(id: string): Promise<void> {
    await this.buscarAlunoPorId(id)
    await this.alunoRepository.delete(id)
  }

  async importarAlunos(arquivos: Partial<Aluno>[]): Promise<void> {
    for (const registro of arquivos) {
      if (!registro.ra || !registro.emailAcademico || !registro.nome) {
        continue
      }

      const existeAluno = await this.alunoRepository.findByRa(registro.ra)
      if (existeAluno) {
        continue
      }

      await this.alunoRepository.create({
        ...registro,
        senha: registro.senha ? await hash(registro.senha, 10) : await hash("changeme", 10),
        primeiroAcesso: registro.primeiroAcesso ?? true,
      })
    }
  }

  async ativarStatusEstagio(id: string): Promise<Aluno> {
    await this.buscarAlunoPorId(id)
    return this.alunoRepository.update(id, { statusAptoEstagio: true })
  }

  async desativarStatusEstagio(id: string): Promise<Aluno> {
    await this.buscarAlunoPorId(id)
    return this.alunoRepository.update(id, { statusAptoEstagio: false })
  }
  async login(emailAcademico: string, senha: string) {
        // Busca o aluno pelo email
        const aluno = await AlunoRepository.findOneBy({ emailAcademico });
        
        // Se não achar o aluno ou a senha não bater, retorna erro
        if (!aluno || aluno.senha !== senha) {
            throw new AppError("E-mail ou senha incorretos", 401);
        }
        
        return aluno;
    }
}


