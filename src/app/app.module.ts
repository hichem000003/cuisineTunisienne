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

@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    FooterComponent,
    RecettesComponent,
    AccueilComponent,
    DetailsrecetteComponent,
    EvenementComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
