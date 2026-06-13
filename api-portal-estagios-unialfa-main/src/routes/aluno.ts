import { Router } from "express"
import { AlunoController } from "../controllers/AlunoController"

const router = Router()
const controller = new AlunoController()
// Adicione junto das outras rotas:
router.post('/login', new AlunoController().login);
router.post("/", (req, res, next) => controller.criar(req, res, next))
router.get("/", (req, res, next) => controller.listar(req, res, next))
router.get("/:id", (req, res, next) => controller.buscar(req, res, next))
router.put("/:id", (req, res, next) => controller.atualizar(req, res, next))
router.delete("/:id", (req, res, next) => controller.deletar(req, res, next))
router.post("/importar", (req, res, next) => controller.importar(req, res, next))
router.patch("/:id/ativar-estagio", (req, res, next) => controller.ativarEstagio(req, res, next))
router.patch("/:id/desativar-estagio", (req, res, next) => controller.desativarEstagio(req, res, next))


export default router
