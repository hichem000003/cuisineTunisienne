import { TestBed } from '@angular/core/testing';



describe('FavorisService', () => {
  let service: FavorisService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(FavorisService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
