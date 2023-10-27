/*=========================================================================================
    File Name: form-wizard.js
    Description: Wizard step page, universal. Make sure to have select2,bs-stepper before adding this
    ----------------------------------------------------------------------------------------
    Author: Unijaya - Hafiz
    Author Contact: +6019-2334157
==========================================================================================*/

$(function () {
    'use strict';

    var bsStepper = document.querySelectorAll('.bs-stepper'),
        select = $('.select2'),
        horizontalWizardList = document.querySelectorAll('.horizontal-wizard'),
        verticalWizardList = document.querySelectorAll('.vertical-wizard'),
        modernWizardList = document.querySelectorAll('.modern-wizard'),
        modernVerticalWizardList = document.querySelectorAll('.modern-vertical-wizard');


    // Adds crossed class
    if (typeof bsStepper !== undefined && bsStepper !== null) {
        for (var el = 0; el < bsStepper.length; ++el) {
            bsStepper[el].addEventListener('show.bs-stepper', function (event) {
                var index = event.detail.indexStep;
                var numberOfSteps = $(event.target).find('.step').length - 1;
                var line = $(event.target).find('.step');

                // The first for loop is for increasing the steps,
                // the second is for turning them off when going back
                // and the third with the if statement because the last line
                // can't seem to turn off when I press the first item. ¯\_(ツ)_/¯

                for (var i = 0; i < index; i++) {
                    line[i].classList.add('crossed');

                    for (var j = index; j < numberOfSteps; j++) {
                        line[j].classList.remove('crossed');
                    }
                }
                if (event.detail.to == 0) {
                    for (var k = index; k < numberOfSteps; k++) {
                        line[k].classList.remove('crossed');
                    }
                    line[0].classList.remove('crossed');
                }
            });
        }
    }

    // select2
    select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
        placeholder: 'Sila Pilih',
        dropdownParent: $this.parent()
        });
    });

    //Horizontal Wizard All
    // --------------------------------------------------------------------
    if (typeof horizontalWizardList !== undefined && horizontalWizardList !== null) {

        var numberedStepperList = [];
        horizontalWizardList.forEach((horizontalWizard,index) => {
            numberedStepperList[index] = new Stepper(horizontalWizard);

            $(horizontalWizard)
            .find('.btn-next')
            .on('click', function (e) {
                numberedStepperList[index].next();
            });

            $(horizontalWizard)
            .find('.btn-prev')
            .on('click', function () {
                numberedStepperList[index].previous();
            });
        });
    }

    //Vertical Wizard All
    // --------------------------------------------------------------------
    if (typeof verticalWizardList !== undefined && verticalWizardList !== null) {
        var verticalStepperList = [];
        verticalWizardList.forEach((verticalWizard,index) => {

            verticalStepperList[index] = new Stepper(verticalWizard, {
                linear: false
            });

            $(verticalWizard)
            .find('.btn-next')
            .on('click', function () {
                verticalStepperList[index].next();
            });

            $(verticalWizard)
            .find('.btn-prev')
            .on('click', function () {
                verticalStepperList[index].previous();
            });
        });
    }

    // Modern Wizard All
    // --------------------------------------------------------------------
    if (typeof modernWizardList !== undefined && modernWizardList !== null) {

        var modernStepperList = [];
        modernWizardList.forEach((modernWizard,index) => {

            modernStepperList[index] = new Stepper(modernWizard, {
                linear: false
            });

            $(modernWizard)
            .find('.btn-next')
            .on('click', function () {
                modernStepperList[index].next();
            });

            $(modernWizard)
            .find('.btn-prev')
            .on('click', function () {
                modernStepperList[index].previous();
            });

        });
    }

    // Modern Vertical Wizard All
    // --------------------------------------------------------------------
    if (typeof modernVerticalWizardList !== undefined && modernVerticalWizardList !== null) {

        var modernVerticalStepperList = [];
        modernVerticalWizardList.forEach((modernVerticalWizard,index) => {
            modernVerticalStepperList[index] = new Stepper(modernVerticalWizard, {
                linear: false
            });

            $(modernVerticalWizard)
            .find('.btn-next')
            .on('click', function () {
                modernVerticalStepperList[index].next();
            });

            $(modernVerticalWizard)
            .find('.btn-prev')
            .on('click', function () {
                modernVerticalStepperList[index].previous();
            });
        });
    }
});
