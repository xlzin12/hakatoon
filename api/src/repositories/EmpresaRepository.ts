import { AppDataSource } from "../database/data-source"
import { Empresa } from "../entities/Empresa"
import { BaseRepository } from "./BaseRepository"

export class EmpresaRepository extends BaseRepository<Empresa> {
  constructor() {
    super(AppDataSource.getRepository(Empresa))
  }

  async findByEmail(email: string): Promise<Empresa | null> {
    return this.repository.findOne({ where: { emailCoportaivo: email } })
  }

}
