import cors from "cors"
import dotenv from "dotenv"
import express from "express"
import { AppDataSource } from "./database/data-source"
import { errorHandler } from "./middleware/erros"
import alunoRoutes from "./routes/aluno"
import empresaRoutes from "./routes/empresa"
import vagaRoutes from "./routes/vaga"
import candidaturaRoutes from "./routes/candidatura"

dotenv.config()

const app = express()
const PORT = Number(process.env.PORT || 3001)
const FRONTEND_URL = process.env.FRONTEND_URL || "http://localhost:3000"


app.use(express.json())

app.use(cors({
    origin: FRONTEND_URL,
    credentials: true,
}))

app.use('/alunos', alunoRoutes)
app.use('/empresas', empresaRoutes)
app.use('/vagas', vagaRoutes)
app.use('/candidaturas', candidaturaRoutes)

app.use(errorHandler)

app.listen(PORT, () => {
    console.log('Iniciou o servidor na porta:' +
        PORT
    )
})


// Apague o app.listen que estava solto aqui em cima...

// E deixe a inicialização do banco assim:
AppDataSource.initialize()
    .then(() => {
        console.log('Conectou no Banco de Dados')
        
        // 🚨 Colocamos o servidor para ligar SÓ DEPOIS do banco estar pronto!
        app.listen(PORT, () => {
            console.log('Iniciou o servidor na porta:' + PORT)
        })
    })
    .catch((err) => {
        console.log("Erro ao conectar no banco de dados")
        console.log(err)
    })

// AppDataSource.initialize()
//     .then(() => {
//         console.log('Conectou no Banco de Dados')
//     })
//     .catch((err) => {
//         console.log("Erro ao conectar no banco de dados")
//         console.log(err)
//     })