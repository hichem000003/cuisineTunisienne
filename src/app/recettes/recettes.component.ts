import { Component, OnInit } from '@angular/core';
import { RecettesService } from '../recettes.service';
import { Recette } from '../recette';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';


@Component({
  selector: 'app-recettes',
  templateUrl: './recettes.component.html',
  styleUrls: ['./recettes.component.css']
})
export class RecettesComponent implements OnInit {

  recettes:Recette[];
  recette:Recette;
  submitted = false;
    constructor(private recettesService:RecettesService,
      private router: Router) { }
  ngOnInit(): void {
    this.getRecettes();



    this.recettesService.getRecetteByID("4").subscribe((data) => {


      this.recettes=data as any;



    });

    console.log("fvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv"+this.recettes);
  }


  getRecettes(): void {
    this.recettesService.getrecette()
        .subscribe(recettes => {
          this.recettes = recettes;
          console.log('recettes liste',this.recettes);
        });
}



  }
