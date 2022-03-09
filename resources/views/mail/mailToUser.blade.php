@component('mail::message')
    # Deliveboo

    Grazie {{ $order['name'] }},

    il tuo ordine è stato preso in carico dal ristorante.

    A breve riceverai i piatti che hai selezionato all'indirizzo {{ $order['address'] }}.

    La tua spesa totale è di {{ $order['amount'] }} €.

    Grazie per aver odrinato da noi!
    Deliveboo
@endcomponent
