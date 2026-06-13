import { NextFunction, Request, Response } from "express"
import { AppError } from "../utils/AppError"
import { VagaService } from "../services/VagaService"

export class VagaController {
  private vagaService: VagaService

  constructor() {
    this.vagaService = new VagaService()
  }

  async criar(req: Request, res: Response, next: NextFunction) {
    try {
      const vaga = await this.vagaService.criarVaga(req.body)
      return res.status(201).json({ success: true, data: vaga })
    } catch (error) {
      next(error)
    }
  }

  async listar(req: Request, res: Response, next: NextFunction) {
    try {
      const vagas = await this.vagaService.listarVagas()
      return res.status(200).json({ success: true, data: vagas })
    } catch (error) {
      next(error)
    }
  }

  async buscar(req: Request, res: Response, next: NextFunction) {
    try {
      const id = Array.isArray(req.params.id) ? req.params.id[0] : req.params.id
      if (!id) {
        throw new AppError("ID inválido", 400)
      }

      const vaga = await this.vagaService.buscarVagaPorId(id)
      return res.status(200).json({ success: true, data: vaga })
    } catch (error) {
      next(error)
    }
  }

  async atualizar(req: Request, res: Response, next: NextFunction) {
    try {
      const id = Array.isArray(req.params.id) ? req.params.id[0] : req.params.id
      if (!id) {
        throw new AppError("ID inválido", 400)
      }

      const vaga = await this.vagaService.atualizarVaga(id, req.body)
      return res.status(200).json({ success: true, data: vaga })
    } catch (error) {
      next(error)
    }
  }

  async deletar(req: Request, res: Response, next: NextFunction) {
    try {
      const id = Array.isArray(req.params.id) ? req.params.id[0] : req.params.id
      if (!id) {
        throw new AppError("ID inválido", 400)
      }

      await this.vagaService.deletarVaga(id)
      return res.status(200).json({ success: true, data: null })
    } catch (error) {
      next(error)
    }
  }

  async listarAbertas(req: Request, res: Response, next: NextFunction) {
    try {
      const vagas = await this.vagaService.listarVagasAbertas()
      return res.status(200).json({ success: true, data: vagas })
    } catch (error) {
      next(error)
    }
  }

  async fechar(req: Request, res: Response, next: NextFunction) {
    try {
      const id = Array.isArray(req.params.id) ? req.params.id[0] : req.params.id
      if (!id) {
        throw new AppError("ID inválido", 400)
      }

      const vaga = await this.vagaService.fecharVaga(id)
      return res.status(200).json({ success: true, data: vaga })
    } catch (error) {
      next(error)
    }
  }
}
