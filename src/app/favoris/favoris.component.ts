import { Component, OnInit } from '@angular/core';
import { FavorisService } from '../favoris.service';
import { Favori } from '../favori';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Router } from '@angular/router';

@Component({
  selector: 'app-favoris',
  templateUrl: './favoris.component.html',
  styleUrls: ['./favoris.component.css']
})
export class FavorisComponent implements OnInit {

  favoris:Favori[];
  favori:Favori;
  submitted = false;
    constructor(private favorisService:FavorisService,
      private router: Router) { }

    ngOnInit() {
this.getFavoris();
    }


    getFavoris(): void {
      this.favorisService.getfavoris()
          .subscribe(favoris => {
            this.favoris = favoris;
            console.log('favoris liste',this.favoris);
          });
}
newFavori(): void {
  this.submitted = false;
  this.favori = new Favori;
}

save() {
  this.favorisService.createFavoris(this.favori)
    .subscribe(data => console.log(data), error => console.log(error));
  this.favori = new Favori();
  //this.gotoList();
}

onSubmit() {
  this.submitted = true;
  this.save();
}

gotoList() {
  this.router.navigate(['/favoris']);
}
delete(favori:Favori): void {
  this.favorisService.deleteFavori(favori).subscribe(
    data => {
      console.log(data);
      this.getFavoris();
    },
    error => console.log(error)
  );
  //window.location.replace('/books');
}

}
