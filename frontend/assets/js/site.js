/**
 * Created by ewa on 13.06.17.
 */
$('#waiting-at-customer-button').click(function () {

    var waitingAtCustomerList = $('.waiting-at-customer-list');
    var waitingForReturnList = $('.waiting-for-return-list');
    var waitingForReturnButton = $('#waiting-for-return-button');
    if (waitingAtCustomerList.hasClass('disactive')) {
        $(this).removeClass('btn-site');
        $(this).addClass('btn-active');
        waitingAtCustomerList.removeClass('disactive');
        waitingForReturnList.removeClass('active');
        waitingForReturnButton.removeClass('btn-active');
        waitingForReturnButton.addClass('btn-site');

    }
});

$('#waiting-for-return-button').click(function () {
    $(this).removeClass('btn-site');
    $(this).addClass('btn-active');
    var waitingAtCustomerButton = $('#waiting-at-customer-button');
    var waitingAtCustomerList = $('.waiting-at-customer-list');
    var waitingForReturnList = $('.waiting-for-return-list');

    waitingAtCustomerButton.removeClass('btn-active');
    waitingAtCustomerButton.addClass('btn-site');
    waitingForReturnList.addClass('active');
    waitingAtCustomerList.addClass('disactive');
});
