import {
  Column,
  CreateDateColumn,
  Entity,
  OneToMany,
  PrimaryGeneratedColumn,
  UpdateDateColumn
} from "typeorm";

import { Vaga } from "./Vaga";

@Entity({ name: "empresas" })
export class Empresa {
  @PrimaryGeneratedColumn("uuid")
  id!: string;

  @Column({ unique: true })
  cnpj!: string;

  @Column()
  nomeFantasia!: string;

  @Column()
  razaoSocial!: string;

  @Column({ unique: true })
  emailCoportaivo!: string;

  @Column()
  senhaHash!: string;

  @Column({ type: "varchar", default: "PENDENTE" })
  statusAprovacao!: "PENDENTE" | "APROVADO" | "BLOQUEADO";

  // --- DADOS COMPLEMENTARES ---
  @Column({ nullable: true })
  telefone!: string;

  @Column({ type: "text", nullable: true })
  descricaoEmpresa!: string; // "Sobre a empresa"

  @Column({ nullable: true })
  website!: string;

  // --- RELACIONAMENTOS ---
  @OneToMany(() => Vaga, (vaga) => vaga.empresa)
  vagas!: Vaga[];

  @CreateDateColumn()
  created_at!: Date;

  @UpdateDateColumn()
  updated_at!: Date;
}