import { Injectable } from '@angular/core';
import { Favori } from './favori';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, map, tap } from 'rxjs/operators';
const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};
@Injectable({
  providedIn: 'root'
})
export class FavorisService {
  private handleError<T> (operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {

      // TODO: send the error to remote logging infrastructure
      console.error(error); // log to console instead

      // TODO: better job of transforming error for user consumption
      console.log(`${operation} failed: ${error.message}`);

      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }

  public baseUrl = 'http://127.0.0.1:8000';



  constructor(private http: HttpClient) { }



  getfavoris (): Observable<Favori[]> {
    return this.http.get<Favori[]>(this.baseUrl + '/findFavoris').pipe(
      tap(_ => console.log('fetched Favoris')),
      catchError(this.handleError<Favori[]>('getFavoris', []))
    );

  }
  createFavoris(favori: Favori): Observable<any> {
    return this.http.post<Favori>(this.baseUrl + '/newFavoris', favori, httpOptions).pipe(
      tap((newFavori: Favori) => console.log(`added favori w/ id=${newFavori.id}`)),
      catchError(this.handleError<Favori>('create'))
    );
  }
  getFavori(id: number): Observable<any> {
    return this.http.get<Favori>(this.baseUrl + `/showFavoris/${id}`).pipe(
    tap(_ => console.log(`fetched favori w/ id=${id}`)),
    catchError(this.handleError<Favori>('getFavoris')
    ));
    }
 updateFavori(id: number, favori: Favori): Observable<any> {
  return this.http.post<Favori>(this.baseUrl + `/editFavoris/${id}`, favori, httpOptions).pipe(
    tap(_ => console.log(`updated favori w/ id=${favori.id}`)),
    catchError(this.handleError<Favori>('update'))
  );
}
/*
updateFavori(id: number, value: any): Observable<Object> {
  return this.http.put(`${this.baseUrl}/${id}`, value);
}
*/
deleteFavori(favori: Favori | number): Observable<Favori> {
  const id = typeof favori === 'number' ? favori : favori.id;
  const url = this.baseUrl + `/deleteFavoris/${id}`;
  console.log(url);
  return this.http.delete<Favori>(url, httpOptions).pipe(
    tap(_ => console.log(`deleted Favori id=${id}`)),
    catchError(this.handleError<Favori>('delete'))
  );
}


getFavorisList(): Observable<any> {
  return this.http.get(`${this.baseUrl}`);
}
}
