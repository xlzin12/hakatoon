import { AppError } from "../utils/AppError"
import { CandidaturaRepository } from "../repositories/CandidaturaRepository"
import { AlunoRepository } from "../repositories/AlunoRepository"
import { VagaRepository } from "../repositories/VagaRepository"
import { Candidatura } from "../entities/Candidatura"

export class CandidaturaService {
  private candidaturaRepository: CandidaturaRepository
  private alunoRepository: AlunoRepository
  private vagaRepository: VagaRepository

  constructor() {
    this.candidaturaRepository = new CandidaturaRepository()
    this.alunoRepository = new AlunoRepository()
    this.vagaRepository = new VagaRepository()
  }

  async submeterCandidatura(alunoId: string, vagaId: string): Promise<Candidatura> {
    const aluno = await this.alunoRepository.findById(alunoId)
    if (!aluno) {
      throw new AppError("Aluno não encontrado", 404)
    }

    const vaga = await this.vagaRepository.findById(vagaId)
    if (!vaga) {
      throw new AppError("Vaga não encontrada", 404)
    }

    const duplicada = await this.verificarCandidaturaDuplicada(alunoId, vagaId)
    if (duplicada) {
      throw new AppError("Candidatura duplicada: este aluno já se inscreveu nessa vaga", 409)
    }

    const candidatura = await this.candidaturaRepository.create({
      aluno: { id: alunoId } as any,
      vaga: { id: vagaId } as any,
      status: "RECEBIDO",
    })

    return candidatura
  }

  async buscarCandidaturaPorId(id: string): Promise<Candidatura> {
    const candidatura = await this.candidaturaRepository.findById(id)
    if (!candidatura) {
      throw new AppError("Candidatura não encontrada", 404)
    }
    return candidatura
  }

  async listarCandidaturas(): Promise<Candidatura[]> {
    return this.candidaturaRepository.findAll()
  }

  async listarCandidaturasPorAluno(alunoId: string): Promise<Candidatura[]> {
    const aluno = await this.alunoRepository.findById(alunoId)
    if (!aluno) {
      throw new AppError("Aluno não encontrado", 404)
    }
    return this.candidaturaRepository.findByAluno(alunoId)
  }

  async listarCandidaturasPorVaga(vagaId: string): Promise<Candidatura[]> {
    const vaga = await this.vagaRepository.findById(vagaId)
    if (!vaga) {
      throw new AppError("Vaga não encontrada", 404)
    }
    return this.candidaturaRepository.findByVaga(vagaId)
  }

  async atualizarStatusCandidatura(id: string, novoStatus: Candidatura["status"]): Promise<Candidatura> {
    const candidatura = await this.buscarCandidaturaPorId(id)
    return this.candidaturaRepository.update(id, { status: novoStatus })
  }

  async deletarCandidatura(id: string): Promise<void> {
    await this.buscarCandidaturaPorId(id)
    await this.candidaturaRepository.delete(id)
  }

  async verificarCandidaturaDuplicada(alunoId: string, vagaId: string): Promise<boolean> {
    const candidaturas = await this.candidaturaRepository.findByAluno(alunoId)
    return candidaturas.some((candidatura) => candidatura.vaga.id === vagaId)
  }
}
