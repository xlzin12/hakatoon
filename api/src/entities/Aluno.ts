import {
  Column,
  CreateDateColumn,
  Entity,
  PrimaryGeneratedColumn,
  UpdateDateColumn,
  OneToMany
} from "typeorm";

import { Candidatura } from "./Candidatura";

@Entity({ name: "alunos" })
export class Aluno {
  @PrimaryGeneratedColumn("uuid")
  id!: string;

  // --- DADOS VINDO DA IMPORTAÇÃO ACADEMICA ---
  @Column({ unique: true })
  ra!: string;

  @Column()
  nome!: string;

  @Column({ unique: true })
  emailAcademico!: string;

  @Column()
  curso!: string;

  @Column()
  periodo!: string;

  @Column({ default: false })
  statusAptoEstagio!: boolean;

  @Column()
  telefone!: string;

  // --- AUTENTICACAO ---

  @Column()
  senha!: string;
  
  @Column({ default: true })
  primeiroAcesso!: boolean;

  // --- DADOS COMPLEMENTARES DO USUÁRIO ---

  @Column({ type: "text", nullable: true })
  resumoProfissional!: string; 

  @Column({ type: "simple-json", nullable: true })
  linksSociais!: { github?: string; linkedin?: string; portfolio?: string }; 

  @Column({ type: "simple-array", nullable: true })
  habilidades!: string[];

  // --- HISTORICO, PROJETOS E CERTIFICADOS ---

  @Column({ type: "json", nullable: true })
  projetosExtensao!: { titulo: string; descricao: string; link?: string }[];

  @Column({ type: "json", nullable: true })
  certificados!: { nome: string; instituicao: string; cargaHoraria: number; url?: string }[];

  @Column({ type: "text", nullable: true })
  experienciaPrevia!: string; 

  // -- RELACIONAMENTOS ---
  @OneToMany(() => Candidatura, (candidatura) => candidatura.aluno)
  candidaturas!: Candidatura[];

  @CreateDateColumn()
  created_at!: Date;

  @UpdateDateColumn()
  updated_at!: Date;
}