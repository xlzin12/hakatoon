import { DeepPartial, QueryDeepPartialEntity, Repository } from "typeorm"

export abstract class BaseRepository<T extends { id: string }> {
  protected repository: Repository<T>

  constructor(repository: Repository<T>) {
    this.repository = repository
  }

  async create(dados: DeepPartial<T>): Promise<T> {
    const entity = this.repository.create(dados)
    return this.repository.save(entity)
  }

  async findById(id: string): Promise<T | null> {
    return this.repository.findOne({ where: { id } as any })
  }

  async findAll(): Promise<T[]> {
    return this.repository.find()
  }

  async update(id: string, dados: QueryDeepPartialEntity<T>): Promise<T> {
    await this.repository.update(id, dados)
    const entity = await this.findById(id)
    if (!entity) {
      throw new Error("Registro não encontrado")
    }
    return entity
  }

  async delete(id: string): Promise<void> {
    await this.repository.delete(id)
  }
}
