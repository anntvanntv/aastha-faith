<?php namespace ProcessWire; ?>

<div id="content">

    <h1>Add Story</h1>

    <form>

        <p>
            <label>Title</label><br>
            <input type="text" name="title">
        </p>

        <p>
            <label>Category</label><br>
            <input type="text" name="category">
        </p>

        <p>
            <label>Date</label><br>
            <input type="date" name="date">
        </p>

        <p>
            <label>Body</label><br>
            <textarea name="body"></textarea>
        </p>

        <button type="submit">
            Save Story
        </button>

    </form>

</div>