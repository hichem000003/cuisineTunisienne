import { Recette } from './recette';
import { Membre } from './membre';
export class Favori {
  id: number;
  num: number;
  date_publication: string;
  recette: Recette;
  membre: Membre;
}
