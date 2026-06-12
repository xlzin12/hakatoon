import { AppDataSource } from "../database/data-source"
import { Vaga } from "../entities/Vaga"
import { BaseRepository } from "./BaseRepository"

export class VagaRepository extends BaseRepository<Vaga> {
  constructor() {
    super(AppDataSource.getRepository(Vaga))
  }

  async findByEmpresa(empresaId: string): Promise<Vaga[]> {
    return this.repository.find({ where: { empresa: { id: empresaId } } })
  }

  async findAbertas(): Promise<Vaga[]> {
    return this.repository.find({ where: { ativa: true } })
  }
}
