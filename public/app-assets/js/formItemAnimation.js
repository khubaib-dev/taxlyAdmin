function addItem() {
    var itemizedPart = document.getElementById("itemizedPart");
    var newItem = document.createElement("div");
    newItem.className = "item";
    newItem.innerHTML = `
      <label>Item #: </label>
      <input type="number" name="itemNumber" class="form-control item-number">
      <br>
      <label>Outfit Name: </label>
      <input type="text" name="outfitName" class="form-control outfit-name">
      <br>
      <label>Outfit Description: </label>
      <input type="text" name="outfitDescription" class="form-control outfit-description">
      <br>
      <label>Price: </label>
      <input type="number" name="price" class="form-control price">
      <br>
      <label>Hours: </label>
      <input type="number" name="hours" class="form-control hours">
      <br>
      <div class="item-actions">
        <button class="delete-item">Delete</button>
        <button class="move-up item-move-btn">Move Up</button>
        <button class="move-down item-move-btn">Move Down</button>
      </div>
    `;
    itemizedPart.appendChild(newItem);
    addEventListeners(newItem);
  }

  function deleteItem(button) {
    var item = button.closest(".item");
    item.classList.add("deleting");
    setTimeout(function() {
      item.parentNode.removeChild(item);
    }, 300);
  }

  function moveUp(button) {
    var item = button.closest(".item");
    var prevItem = item.previousElementSibling;
    if (prevItem) {
      var placeholder = document.createElement("div");
      itemizedPart.insertBefore(placeholder, item);
      itemizedPart.insertBefore(item, prevItem);
      itemizedPart.replaceChild(placeholder, prevItem);
    }
  }

  function moveDown(button) {
    var item = button.closest(".item");
    var nextItem = item.nextElementSibling;
    if (nextItem) {
      var placeholder = document.createElement("div");
      itemizedPart.insertBefore(placeholder, nextItem.nextElementSibling);
      itemizedPart.insertBefore(nextItem, item);
      itemizedPart.replaceChild(placeholder, item);
    }
  }

  function addEventListeners(item) {
    var deleteButton = item.querySelector(".delete-item");
    deleteButton.addEventListener("click", function(event) {
      event.preventDefault();
      deleteItem(this);
    });

    var moveUpButton = item.querySelector(".move-up");
    moveUpButton.addEventListener("click", function(event) {
      event.preventDefault();
      moveUp(this);
    });

    var moveDownButton = item.querySelector(".move-down");
    moveDownButton.addEventListener("click", function(event) {
      event.preventDefault();
      moveDown(this);
    });
  }

  var itemizedPart = document.getElementById("itemizedPart");
  addEventListeners(itemizedPart.querySelector(".item"));