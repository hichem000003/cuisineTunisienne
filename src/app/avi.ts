import { Recette } from './recette';
import { Membre } from './membre';
export class Avi {
  id: number;
  Titre: string;
  contenu_commentaire: string;
  date_commentaire: string;
  note: number;
  recette: Recette;
  membre: Membre;
}
