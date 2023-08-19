// Add block button click event
document.getElementById("add-block").addEventListener("click", function() {
    addBlock();
  });
  
  // Move up button click event
  document.addEventListener("click", function(event) {
    if (event.target && event.target.className === "move-up") {
      moveUp(event.target.parentNode.parentNode);
    }
  });
  
  // Move down button click event
  document.addEventListener("click", function(event) {
    if (event.target && event.target.className === "move-down") {
      moveDown(event.target.parentNode.parentNode);
    }
  });
  
  // Delete button click event
  document.addEventListener("click", function(event) {
    if (event.target && event.target.className === "delete") {
      deleteBlock(event.target.parentNode.parentNode);
    }
  });
  
  // Function to add a new block
  function addBlock() {
    const blockContainer = document.getElementById("block-container");
  
    // Create a new block element
    const newBlock = document.createElement("div");
    newBlock.classList.add("block");
  
    // Add input fields
    const inputField1 = createInputField("number", "Enter Item #");
    const inputField2 = createInputField("text", "Enter Outfit name..");
    const inputField3 = createInputField("text", "Enter Outfit Description..");
    const inputField4 = createInputField("number", "Enter Price..");
    const inputField5 = createInputField("number", "Enter Hours..");
  
    // Add button block
    const buttonBlock = document.createElement("div");
    buttonBlock.classList.add("button-block");
  
    // Add move up button
    const moveUpButton = createButton("move-up", "Move Up");

    // Add move down button
    const moveDownButton = createButton("move-down", "Move Down");
  
    // Add delete button
    const deleteButton = createButton("delete", "Delete Outfit");
  
    // Append elements to the new block
    buttonBlock.appendChild(moveUpButton);
    buttonBlock.appendChild(moveDownButton);
    buttonBlock.appendChild(deleteButton);
    newBlock.appendChild(inputField1);
    newBlock.appendChild(inputField2);
    newBlock.appendChild(inputField3);
    newBlock.appendChild(inputField4);
    newBlock.appendChild(inputField5);
    newBlock.appendChild(buttonBlock);
  
    // Append the new block to the container
    blockContainer.appendChild(newBlock);
  }
  
  // Function to create an input field
  function createInputField(type, placeholder) {
    const inputField = document.createElement("input");
    inputField.type = type;
    inputField.classList.add("input-field");
    inputField.placeholder = placeholder;
    return inputField;
  }
  
  // Function to create a button
  function createButton(className, text) {
    const button = document.createElement("button");
    button.classList.add(className);
    button.textContent = text;
    return button;
  }
  
  // Function to move a block up
  function moveUp(block) {
    const previousBlock = block.previousElementSibling;
    if (previousBlock) {
      block.parentNode.insertBefore(block, previousBlock);
    }
  }
  
  // Function to move a block down
  function moveDown(block) {
    const nextBlock = block.nextElementSibling;
    if (nextBlock) {
      block.parentNode.insertBefore(nextBlock, block);
    }
  }
  
  // Function to delete a block
  function deleteBlock(block) {
    block.parentNode.removeChild(block);
  }
  