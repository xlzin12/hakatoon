import { NextFunction, Request, Response } from "express"
import { AppError } from "../utils/AppError"
import { AlunoService } from "../services/AlunoService"

export class AlunoController {
  private alunoService: AlunoService

  constructor() {
    this.alunoService = new AlunoService()
  }

  async criar(req: Request, res: Response, next: NextFunction) {
    try {
      const aluno = await this.alunoService.criarAluno(req.body)
      return res.status(201).json({ success: true, data: aluno })
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

      const aluno = await this.alunoService.buscarAlunoPorId(id)
      return res.status(200).json({ success: true, data: aluno })
    } catch (error) {
      next(error)
    }
  }

  async listar(req: Request, res: Response, next: NextFunction) {
    try {
      const alunos = await this.alunoService.listarAlunos()
      return res.status(200).json({ success: true, data: alunos })
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

      const aluno = await this.alunoService.atualizarAluno(id, req.body)
      return res.status(200).json({ success: true, data: aluno })
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

      await this.alunoService.deletarAluno(id)
      return res.status(200).json({ success: true, data: null })
    } catch (error) {
      next(error)
    }
  }

  async importar(req: Request, res: Response, next: NextFunction) {
    try {
      const alunos = req.body
      await this.alunoService.importarAlunos(alunos)
      return res.status(200).json({ success: true, data: null })
    } catch (error) {
      next(error)
    }
  }

  
}
