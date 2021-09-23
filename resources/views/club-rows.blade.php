@foreach($clubs as $position => $club)
<tr>
    <th scope="row">
        {{ $position + 1 }}
    </th>
    <td>
        <span class="badge badge-image-container">
            <img alt="{{ $club->name }}" class="badge-image" src="{{ $club->img }}">
        </span>
        {{ $club->name }}
    </td>
    <td>{{ $club->played }}</td>
    <td>{{ $club->won }}</td>
    <td>{{ $club->drawn }}</td>
    <td>{{ $club->lost }}</td>
    <td>{{ $club->goals_for - $club->goals_against }}</td>
    <td>{{ $club->points }}</td>
</tr>
@endforeach
