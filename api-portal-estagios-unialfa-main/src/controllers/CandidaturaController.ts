import { NextFunction, Request, Response } from "express"
import { AppError } from "../utils/AppError"
import { CandidaturaService } from "../services/CandidaturaService"

export class CandidaturaController {
  private candidaturaService: CandidaturaService

  constructor() {
    this.candidaturaService = new CandidaturaService()
  }

  async criar(req: Request, res: Response, next: NextFunction) {
    try {
      const { alunoId, vagaId } = req.body
      if (!alunoId || !vagaId) {
        throw new AppError("AlunoId e vagaId são obrigatórios", 400)
      }

      const candidatura = await this.candidaturaService.submeterCandidatura(alunoId, vagaId)
      return res.status(201).json({ success: true, data: candidatura })
    } catch (error) {
      next(error)
    }
  }

  async listar(req: Request, res: Response, next: NextFunction) {
    try {
      const candidaturas = await this.candidaturaService.listarCandidaturas()
      return res.status(200).json({ success: true, data: candidaturas })
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

      const candidatura = await this.candidaturaService.buscarCandidaturaPorId(id)
      return res.status(200).json({ success: true, data: candidatura })
    } catch (error) {
      next(error)
    }
  }

  async atualizarStatus(req: Request, res: Response, next: NextFunction) {
    try {
      const id = Array.isArray(req.params.id) ? req.params.id[0] : req.params.id
      const { status } = req.body
      if (!id || !status) {
        throw new AppError("ID e status são obrigatórios", 400)
      }

      const candidatura = await this.candidaturaService.atualizarStatusCandidatura(id, status)
      return res.status(200).json({ success: true, data: candidatura })
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

      await this.candidaturaService.deletarCandidatura(id)
      return res.status(200).json({ success: true, data: null })
    } catch (error) {
      next(error)
    }
  }
}
