import { NextFunction, Request, Response } from "express"
import { AppError } from "../utils/AppError"
import { EmpresaService } from "../services/EmpresaService"

export class EmpresaController {
  private empresaService: EmpresaService

  constructor() {
    this.empresaService = new EmpresaService()
  }

  async criar(req: Request, res: Response, next: NextFunction) {
    try {
      const empresa = await this.empresaService.criarEmpresa(req.body)
      return res.status(201).json({ success: true, data: empresa })
    } catch (error) {
      next(error)
    }
  }

  async listar(req: Request, res: Response, next: NextFunction) {
    try {
      const { status } = req.query
      const empresas = await this.empresaService.listarEmpresas(
        typeof status === "string" ? status as any : undefined
      )
      return res.status(200).json({ success: true, data: empresas })
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

      const empresa = await this.empresaService.buscarEmpresaPorId(id)
      return res.status(200).json({ success: true, data: empresa })
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

      const empresa = await this.empresaService.atualizarEmpresa(id, req.body)
      return res.status(200).json({ success: true, data: empresa })
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

      await this.empresaService.deletarEmpresa(id)
      return res.status(200).json({ success: true, data: null })
    } catch (error) {
      next(error)
    }
  }

  async aprovar(req: Request, res: Response, next: NextFunction) {
    try {
      const id = Array.isArray(req.params.id) ? req.params.id[0] : req.params.id
      if (!id) {
        throw new AppError("ID inválido", 400)
      }

      const empresa = await this.empresaService.aprovarEmpresa(id)
      return res.status(200).json({ success: true, data: empresa })
    } catch (error) {
      next(error)
    }
  }

  async bloquear(req: Request, res: Response, next: NextFunction) {
    try {
      const id = Array.isArray(req.params.id) ? req.params.id[0] : req.params.id
      if (!id) {
        throw new AppError("ID inválido", 400)
      }

      const empresa = await this.empresaService.bloquearEmpresa(id)
      return res.status(200).json({ success: true, data: empresa })
    } catch (error) {
      next(error)
    }
  }
  async login(req: Request, res: Response) {
        const { emailCorporativo, senhaHash } = req.body;
        
        const empresa = await new EmpresaService().login(emailCorporativo, senhaHash);
        
        return res.status(200).json({ data: empresa });
    }
}
