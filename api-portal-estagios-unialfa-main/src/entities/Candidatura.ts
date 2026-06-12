import {
  Column,
  CreateDateColumn,
  Entity,
  PrimaryGeneratedColumn,
  UpdateDateColumn,
  ManyToOne
} from "typeorm";
import { Aluno } from "./Aluno";
import { Vaga } from "./Vaga";

@Entity({ name: "candidaturas" })
export class Candidatura {
  @PrimaryGeneratedColumn("uuid")
  id!: string;

  @Column({ type: "varchar", default: "RECEBIDO" })
  status!: "RECEBIDO" | "EM_ANALISE" | "ENTREVISTA" | "APROVADO" | "REPROVADO";

  // --- RELACIONAMENTOS ---
  @ManyToOne(() => Aluno, (aluno) => aluno.candidaturas, { onDelete: "CASCADE" })
  aluno!: Aluno;

  @ManyToOne(() => Vaga, (vaga) => vaga.candidaturas, { onDelete: "CASCADE" })
  vaga!: Vaga;

  @CreateDateColumn()
  created_at!: Date;

  @UpdateDateColumn()
  updated_at!: Date;
}

export type UsuarioPublico = Omit<Candidatura, "senha">;