<x-filament-panels::page>
    <p>Имя: <b>{{$this->record->first_name}}</b></p>
    <p>Почта: <b>{{$this->record->email}}</b></p>

    @if($this->record->surveyResults->isNotEmpty())
        <h3>Результаты опроса:</h3>
        <table>
            <tr>
                <td>Сфера</td>
                <td>Значение</td>
            </tr>
            @foreach($this->record->surveyResults as $result)
                <tr>

                    <td>{{$result->survey->category->name}}</td>
                    <td>{{$result->value}}</td>
                </tr>

            @endforeach

        </table>
    @endif
    <br>
    @if($this->record->events->isNotEmpty())

        <h3>Мероприятия:</h3>
        <table>
            <tr>
                <td>Мероприятие</td>
                <td>Дата</td>
            </tr>
            @foreach($this->record->events as $event)
                <tr>
                    <td>{{$event->title}}</td>
                    <td>{{$event->date}}</td>
                </tr>

            @endforeach

        </table>
    @endif

</x-filament-panels::page>
