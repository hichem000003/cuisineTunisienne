import { Injectable } from '@angular/core';
import { Avi } from './avi';
import { Observable, of } from 'rxjs';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, map, tap } from 'rxjs/operators';
const httpOptions = {
  headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};
@Injectable({
  providedIn: 'root'
})
export class AvisService {
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



  getavis (): Observable<Avi[]> {
    return this.http.get<Avi[]>(this.baseUrl + '/findAvis').pipe(
      tap(_ => console.log('fetched Avis')),
      catchError(this.handleError<Avi[]>('getAvis', []))
    );

  }
  createAvis(avi: Avi): Observable<any> {
    return this.http.post<Avi>(this.baseUrl + '/newAvis', avi, httpOptions).pipe(
      tap((newAvi: Avi) => console.log(`added avi w/ id=${newAvi.id}`)),
      catchError(this.handleError<Avi>('create'))
    );
  }
  getAvi(id: number): Observable<any> {
    return this.http.get<Avi>(this.baseUrl + `/showAvis/${id}`).pipe(
    tap(_ => console.log(`fetched avi w/ id=${id}`)),
    catchError(this.handleError<Avi>('getAvis')
    ));
    }
 updateAvi(id: number, avi: Avi): Observable<any> {
  return this.http.post<Avi>(this.baseUrl + `/editAvis/${id}`, avi, httpOptions).pipe(
    tap(_ => console.log(`updated avi w/ id=${avi.id}`)),
    catchError(this.handleError<Avi>('update'))
  );
}

deleteAvi(avi: Avi | number): Observable<Avi> {
  const id = typeof avi === 'number' ? avi : avi.id;
  const url = this.baseUrl + `/deleteAvis/${id}`;
  console.log(url);
  return this.http.delete<Avi>(url, httpOptions).pipe(
    tap(_ => console.log(`deleted Avi id=${id}`)),
    catchError(this.handleError<Avi>('delete'))
  );
}


getAvisList(): Observable<any> {
  return this.http.get(`${this.baseUrl}`);
}
}
