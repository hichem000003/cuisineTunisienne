import { Categorie } from './categorie';
export class Recette {
  id: number;
  categories: Categorie;
  nomRecette:string
  tempsCuisson: string;
  tempsPreparation:string;
  photo	:string;
  video:string;
  nbPersonnes: number;
  niveauDifficulte: number;
  refRecette:string;
}
