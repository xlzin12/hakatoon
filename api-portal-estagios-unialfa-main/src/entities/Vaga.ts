import {
  Column,
  CreateDateColumn,
  Entity,
  PrimaryGeneratedColumn,
  UpdateDateColumn,
  ManyToOne,
  OneToMany
} from "typeorm";
import { Candidatura } from "./Candidatura";
import {Empresa} from "./Empresa";

@Entity({ name: "vagas" })
export class Vaga {
  @PrimaryGeneratedColumn("uuid")
  id!: string;

  @Column()
  titulo!: string;

  @Column({ type: "text" })
  descricao!: string;

  @Column({ type: "text" })
  requisitos!: string;

  @Column({ nullable: true })
  beneficios!: string;

  @Column({ nullable: true })
  cargaHoraria!: string;

  @Column({ nullable: true })
  localizacao!: string;

  @Column({ default: true })
  ativa!: boolean;

  // --- RELACIONAMENTOS ---
  @ManyToOne(() => Empresa, (empresa) => empresa.vagas, { onDelete: "CASCADE" })
  empresa!: Empresa;

  @OneToMany(() => Candidatura, (candidatura) => candidatura.vaga)
  candidaturas!: Candidatura[]

  @CreateDateColumn()
  created_at!: Date;

  @UpdateDateColumn()
  updated_at!: Date;
}