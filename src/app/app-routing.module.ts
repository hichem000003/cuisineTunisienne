import { NgModule } from '@angular/core';
import { FormsModule }   from '@angular/forms';

import { Routes, RouterModule } from '@angular/router';
import { RecettesComponent } from './recettes/recettes.component';
import { AccueilComponent } from './accueil/accueil.component';
import { EvenementComponent  } from './evenement/evenement.component';
import { FavorisComponent  } from './favoris/favoris.component';
import { DetailsrecetteComponent  } from './detailsrecette/detailsrecette.component';
import { AddRecetteComponent } from './add-recette/add-recette.component';
import { DeleteRecetteComponent } from './delete-recette/delete-recette.component';
const routes: Routes = [
  { path: 'recette', component: RecettesComponent },
  { path: 'accueil', component: AccueilComponent },
  { path: 'evenement', component: EvenementComponent },
  { path: 'favoris', component: FavorisComponent },
  { path: 'recetteDetails/:id', component:DetailsrecetteComponent },
  { path: 'addRecette', component:AddRecetteComponent },
  { path: 'deleteRecette', component:DeleteRecetteComponent },


  { path: '', redirectTo: 'accueil', pathMatch: 'full'  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
