import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DeleteRecetteComponent } from './delete-recette.component';

describe('DeleteRecetteComponent', () => {
  let component: DeleteRecetteComponent;
  let fixture: ComponentFixture<DeleteRecetteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DeleteRecetteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DeleteRecetteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
