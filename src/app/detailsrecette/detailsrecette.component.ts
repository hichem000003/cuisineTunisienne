import { Component, OnInit } from '@angular/core';
import {ActivatedRoute} from '@angular/router';
import { RecettesService } from '../recettes.service';
import { Recette } from '../recette';

@Component({
  selector: 'app-detailsrecette',
  templateUrl: './detailsrecette.component.html',
  styleUrls: ['./detailsrecette.component.css']
})
export class DetailsrecetteComponent implements OnInit {

  constructor(private activeRoute: ActivatedRoute,public recetteservice: RecettesService) { }
  id: any;
  recettes:Recette

  ngOnInit(): void {


    this.id = this.activeRoute.snapshot.params.id;

this.recetteservice.getRecetteByID(this.id).subscribe((data) => {


  this.recettes=data as any;

  console.log("fvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv"+this.recettes);

}


  )


  }




}
