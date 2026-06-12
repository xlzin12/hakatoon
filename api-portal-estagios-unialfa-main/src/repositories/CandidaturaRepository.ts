import { AppDataSource } from "../database/data-source"
import { Candidatura } from "../entities/Candidatura"
import { BaseRepository } from "./BaseRepository"

export class CandidaturaRepository extends BaseRepository<Candidatura> {
  constructor() {
    super(AppDataSource.getRepository(Candidatura))
  }

  async findByAluno(alunoId: string): Promise<Candidatura[]> {
    return this.repository.find({ where: { aluno: { id: alunoId } } })
  }

  async findByVaga(vagaId: string): Promise<Candidatura[]> {
    return this.repository.find({ where: { vaga: { id: vagaId } } })
  }

  async findByStatus(status: Candidatura["status"]): Promise<Candidatura[]> {
    return this.repository.find({ where: { status } })
  }
}
