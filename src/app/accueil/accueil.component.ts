import { Component, OnInit } from '@angular/core';







import { RecettesService } from '../recettes.service';
import { Recette } from '../recette';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';





@Component({
  selector: 'app-accueil',
  templateUrl: './accueil.component.html',
  styleUrls: ['./accueil.component.css']
})
export class AccueilComponent implements OnInit {

  recettes:Recette[];
  recette:Recette;
  submitted = false;
    constructor(private recettesService:RecettesService,
      private router: Router) { }
  ngOnInit(): void {
    this.getRecettes();
  }


  getRecettes(): void {
    this.recettesService.getrecette()
        .subscribe(recettes => {
          this.recettes = recettes;
          console.log('recettes liste',this.recettes);
        });
}

}
