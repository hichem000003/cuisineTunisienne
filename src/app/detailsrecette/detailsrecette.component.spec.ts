import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DetailsrecetteComponent } from './detailsrecette.component';

describe('DetailsrecetteComponent', () => {
  let component: DetailsrecetteComponent;
  let fixture: ComponentFixture<DetailsrecetteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DetailsrecetteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DetailsrecetteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
