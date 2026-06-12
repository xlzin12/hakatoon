import { Router } from "express"
import { VagaController } from "../controllers/VagaController"

const router = Router()
const controller = new VagaController()

router.post("/", (req, res, next) => controller.criar(req, res, next))
router.get("/", (req, res, next) => controller.listar(req, res, next))
router.get("/abertas", (req, res, next) => controller.listarAbertas(req, res, next))
router.get("/:id", (req, res, next) => controller.buscar(req, res, next))
router.put("/:id", (req, res, next) => controller.atualizar(req, res, next))
router.delete("/:id", (req, res, next) => controller.deletar(req, res, next))
router.patch("/:id/fechar", (req, res, next) => controller.fechar(req, res, next))

export default router
