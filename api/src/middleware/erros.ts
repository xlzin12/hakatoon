import { NextFunction, Request, Response } from "express"
import { AppError } from "../utils/AppError"

export function errorHandler(err: any, req: Request, res: Response, next: NextFunction) {
    if (err instanceof AppError) {
        return res.status(err.statusCode).json({
            status: err.status,
            message: err.message,
        })
    }

    console.error(err)

    return res.status(500).json({
        status: "error",
        message: "Internal Server Error",
    })
}
