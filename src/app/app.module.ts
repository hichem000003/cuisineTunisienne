import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavbarComponent } from './navbar/navbar.component';
import { FooterComponent } from './footer/footer.component';
import { RecettesComponent } from './recettes/recettes.component';
import { AccueilComponent } from './accueil/accueil.component';
import { DetailsrecetteComponent } from './detailsrecette/detailsrecette.component';
import { EvenementComponent } from './evenement/evenement.component';
import { FavorisComponent } from './favoris/favoris.component';
import
{HttpClientModule}from'@angular/common/http';
import { AvisComponent } from './avis/avis.component';
import { AddRecetteComponent } from './add-recette/add-recette.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import { DeleteRecetteComponent } from './delete-recette/delete-recette.component'


@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    FooterComponent,
    RecettesComponent,
    AccueilComponent,
    DetailsrecetteComponent,
    EvenementComponent,
    FavorisComponent,
    AvisComponent,
    AddRecetteComponent,
    DeleteRecetteComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
  HttpClientModule,
    FormsModule ,
    ReactiveFormsModule

  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
