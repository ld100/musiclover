<?php if (count($items) > 0): ?>
<table cellspacing="0" cellpadding="0">	
<tr>
    <th>Filename</th>
    <th>Artist</th>
    <th>Title</th>
    <th>Album</th>
    <th>Year</th>
    <th>Size</th>
</tr>
<?php foreach ($items as $track): ?>
<tr>
    <td><a href="/media/<?php echo $track->filename; ?>"><?php echo $track->filename; ?></a></td>
    <td><?php echo $track->artist; ?></td>
    <td><?php echo $track->title; ?></td>
    <td><?php echo $track->album; ?></td>
    <td><?php echo $track->year; ?></td>
    <td><?php echo $track->size; ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php else: ?>
<h2>No music to download :(</h2>
<?php endif; ?>

<?php if(1 == 1): ?>
<h2>Subfolders available</h2>
<ul>
    <% @subdirectories.each do |subdir| %>
    [<a href="/subdir/<%=@parent%><%=subdir%>"><%=subdir%></a>]
    <%end%>
</ul>
<?php endif; ?>