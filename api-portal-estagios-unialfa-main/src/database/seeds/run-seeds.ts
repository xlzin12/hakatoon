import "reflect-metadata";
import { AppDataSource } from "../data-source";
import { Aluno } from "../../entities/Aluno";
import { Empresa } from "../../entities/Empresa";
import { Vaga } from "../../entities/Vaga";
import { Candidatura } from "../../entities/Candidatura";

async function rodarSeed() {
  console.log("Iniciando a execução das Seeds no padrão do professor...");
  
  await AppDataSource.initialize();

  const alunoRepo = AppDataSource.getRepository(Aluno);
  const empresaRepo = AppDataSource.getRepository(Empresa);
  const vagaRepo = AppDataSource.getRepository(Vaga);
  const candidaturaRepo = AppDataSource.getRepository(Candidatura);

  // Alunos
  const raAluno1 = "20240001";
  const jaTemAluno1 = await alunoRepo.exists({ where: { ra: raAluno1 } });
  let aluno1Salvo;

  if (!jaTemAluno1) {
    aluno1Salvo = await alunoRepo.save(
      alunoRepo.create({
        ra: raAluno1,
        nome: "Gabriel Priori de Morais",
        emailAcademico: "gabriel.priori@alfa.com",
        curso: "Análise e Desenvolvimento de Sistemas",
        periodo: "4º Período",
        statusAptoEstagio: true,
        telefone: "62999991111",
        senha: raAluno1, // Regra: Senha inicial é o próprio RA
        primeiroAcesso: true,
        habilidades: ["Node.js", "TypeScript", "MySQL"],
        linksSociais: { github: "github.com", linkedin: "linkedin.com" }
      })
    );
    console.log("👨Aluno 1 criado!");
  } else {
    aluno1Salvo = await alunoRepo.findOneBy({ ra: raAluno1 });
  }

  const raAluno2 = "20240002";
  const jaTemAluno2 = await alunoRepo.exists({ where: { ra: raAluno2 } });
  let aluno2Salvo;

  if (!jaTemAluno2) {
    aluno2Salvo = await alunoRepo.save(
      alunoRepo.create({
        ra: raAluno2,
        nome: "Sylvie Exe",
        emailAcademico: "sylvie.exe@alfa.com",
        curso: "Análise e Desenvolvimento de Sistemas",
        periodo: "4º Período",
        statusAptoEstagio: true,
        telefone: "62999992222",
        senha: raAluno2,
        primeiroAcesso: true,
        habilidades: ["PHP", "Laravel", "CSS"],
        linksSociais: { github: "github.com", linkedin: "linkedin.com" }
      })
    );
    console.log("👨‍🎓 Aluno 2 criado!");
  } else {
    aluno2Salvo = await alunoRepo.findOneBy({ ra: raAluno2 });
  }

  // Empresas
  const cnpjEmpresa1 = "12345678000199";
  const jaTemEmpresa1 = await empresaRepo.exists({ where: { cnpj: cnpjEmpresa1 } });
  let emp1Salva;

  if (!jaTemEmpresa1) {
    emp1Salva = await empresaRepo.save(
      empresaRepo.create({
        cnpj: cnpjEmpresa1,
        nomeFantasia: "Alfa Tech",
        razaoSocial: "Alfa Tecnologia LTDA",
        emailCoportaivo: "contato@alfatech.com",
        senhaHash: "123456",
        statusAprovacao: "APROVADO",
        telefone: "62999998888",
        descricaoEmpresa: "Empresa parceira focada em desenvolvimento de software e soluções web.",
        website: "www.alfatech.com"
      })
    );
    console.log("Empresa Alfa Tech criada!");
  } else {
    emp1Salva = await empresaRepo.findOneBy({ cnpj: cnpjEmpresa1 });
  }

  const cnpjEmpresa2 = "98765432000188";
  const jaTemEmpresa2 = await empresaRepo.exists({ where: { cnpj: cnpjEmpresa2 } });

  if (!jaTemEmpresa2) {
    await empresaRepo.save(
      empresaRepo.create({
        cnpj: cnpjEmpresa2,
        nomeFantasia: "Beta Estágios",
        razaoSocial: "Beta Recursos Humanos S.A.",
        emailCoportaivo: "vagas@betarh.com",
        senhaHash: "123456",
        statusAprovacao: "PENDENTE",
        telefone: "62988887777",
        descricaoEmpresa: "Consultoria de RH focada em conectar talentos universitários ao mercado.",
        website: "www.betarh.com"
      })
    );
    console.log("Empresa Beta Estágios criada!");
  }

  // Vagas
  let vaga1Salva;
  let vaga2Salva;

  if (emp1Salva) {
    const tituloVaga1 = "Estágio em Desenvolvimento Web (PHP/Laravel)";
    const jaTemVaga1 = await vagaRepo.exists({ where: { titulo: tituloVaga1 } });

    if (!jaTemVaga1) {
      vaga1Salva = await vagaRepo.save(
        vagaRepo.create({
          titulo: tituloVaga1,
          descricao: "Venha fazer parte do nosso time de desenvolvimento! Você irá atuar na manutenção e criação de novos módulos.",
          requisitos: "Conhecimento básico em PHP, HTML, CSS e Bancos de dados relacionais.",
          beneficios: "Bolsa auxílio de R$ 1.200,00 + Vale Transporte",
          cargaHoraria: "6 horas diárias (30h semanais)",
          localizacao: "Goiânia - GO (Presencial)",
          ativa: true,
          empresa: emp1Salva
        })
      );
      console.log("Vaga 1 (PHP) criada!");
    } else {
      vaga1Salva = await vagaRepo.findOneBy({ titulo: tituloVaga1 });
    }

    const tituloVaga2 = "Estágio em Suporte Técnico e Redes";
    const jaTemVaga2 = await vagaRepo.exists({ where: { titulo: tituloVaga2 } });

    if (!jaTemVaga2) {
      vaga2Salva = await vagaRepo.save(
        vagaRepo.create({
          titulo: tituloVaga2,
          descricao: "Atuar no auxílio ao usuário final, configuração de roteadores e infraestrutura básica.",
          requisitos: "Estar cursando Análise e Desenvolvimento de Sistemas ou Ciência da Computação.",
          beneficios: "Bolsa auxílio de R$ 1.000,00 + Seguro de Vida",
          cargaHoraria: "4 horas diárias (20h semanais)",
          localizacao: "Remoto",
          ativa: true,
          empresa: emp1Salva
        })
      );
      console.log("Vaga 2 (Suporte) criada!");
    } else {
      vaga2Salva = await vagaRepo.findOneBy({ titulo: tituloVaga2 });
    }
  }

  // Candidaturas
  if (aluno1Salvo && aluno2Salvo && vaga1Salva && vaga2Salva) {
    // Verifica se o Aluno 1 já está cadastrado na Vaga 1
    const jaTemCand1 = await candidaturaRepo.exists({
      where: { aluno: { id: aluno1Salvo.id }, vaga: { id: vaga1Salva.id } }
    });
    if (!jaTemCand1) {
      await candidaturaRepo.save(
        candidaturaRepo.create({
          status: "RECEBIDO",
          aluno: aluno1Salvo,
          vaga: vaga1Salva
        })
      );
      console.log("Candidatura 1 criada!");
    }

    // Verifica se o Aluno 2 já está cadastrado na Vaga 1
    const jaTemCand2 = await candidaturaRepo.exists({
      where: { aluno: { id: aluno2Salvo.id }, vaga: { id: vaga1Salva.id } }
    });
    if (!jaTemCand2) {
      await candidaturaRepo.save(
        candidaturaRepo.create({
          status: "EM_ANALISE",
          aluno: aluno2Salvo,
          vaga: vaga1Salva
        })
      );
      console.log("Candidatura 2 criada!");
    }
  }

  console.log("Execução das Seeds concluída com sucesso!");
  await AppDataSource.destroy();
}

rodarSeed().catch(async (err) => {
  console.error("Erro ao rodar as seeds:", err);
  if (AppDataSource.isInitialized) await AppDataSource.destroy();
  process.exit(1);
});