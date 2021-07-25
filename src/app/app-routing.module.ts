import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { RecettesComponent } from './recettes/recettes.component';
import { AccueilComponent } from './accueil/accueil.component';
import { EvenementComponent  } from './evenement/evenement.component';
const routes: Routes = [
  { path: 'recette', component: RecettesComponent },
  { path: 'accueil', component: AccueilComponent },
  { path: 'evenement', component: EvenementComponent },
  { path: '', redirectTo: 'accueil', pathMatch: 'full'  },
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
