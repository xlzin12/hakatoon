import { Router } from "express"
import { CandidaturaController } from "../controllers/CandidaturaController"

const router = Router()
const controller = new CandidaturaController()

router.post("/", (req, res, next) => controller.criar(req, res, next))
router.get("/", (req, res, next) => controller.listar(req, res, next))
router.get("/:id", (req, res, next) => controller.buscar(req, res, next))
router.put("/:id/status", (req, res, next) => controller.atualizarStatus(req, res, next))
router.delete("/:id", (req, res, next) => controller.deletar(req, res, next))

export default router
