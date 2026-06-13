import { Router } from "express"
import { EmpresaController } from "../controllers/EmpresaController"

const router = Router()
const controller = new EmpresaController()
router.post("/", (req, res, next) => controller.criar(req, res, next))
router.get("/", (req, res, next) => controller.listar(req, res, next))
router.get("/:id", (req, res, next) => controller.buscar(req, res, next))
router.put("/:id", (req, res, next) => controller.atualizar(req, res, next))
router.delete("/:id", (req, res, next) => controller.deletar(req, res, next))
router.patch("/:id/aprovar", (req, res, next) => controller.aprovar(req, res, next))


export default router
