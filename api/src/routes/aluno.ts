import { Router } from "express"
import { AlunoController } from "../controllers/AlunoController"

const router = Router()
const controller = new AlunoController()
// Adicione junto das outras rotas:

router.post("/", (req, res, next) => controller.criar(req, res, next))
router.get("/", (req, res, next) => controller.listar(req, res, next))
router.get("/:id", (req, res, next) => controller.buscar(req, res, next))
router.put("/:id", (req, res, next) => controller.atualizar(req, res, next))
router.delete("/:id", (req, res, next) => controller.deletar(req, res, next))
router.post("/importar", (req, res, next) => controller.importar(req, res, next))

export default router
