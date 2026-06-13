import { AppDataSource } from "../database/data-source"
import { Aluno } from "../entities/Aluno"
import { BaseRepository } from "./BaseRepository"

export class AlunoRepository extends BaseRepository<Aluno> {
  constructor() {
    super(AppDataSource.getRepository(Aluno))
  }

  async findByEmail(email: string): Promise<Aluno | null> {
    return this.repository.findOne({ where: { emailAcademico: email } })
  }

  async findByRa(ra: string): Promise<Aluno | null> {
    return this.repository.findOne({ where: { ra } })
  }
}
