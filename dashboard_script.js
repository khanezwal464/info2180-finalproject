document.addEventListener('DOMContentLoaded', (e)=>{
    var table = document.getElementById('result');
    var gen = document.getElementById('General');
    var sale = document.getElementById('Sales');
    var support = document.getElementById('Support');
    var assigned = document.getElementById('Assigned');
    var php_file = "filter.php";
    var button = document.getElementById('newContact');

    function filterTable(option){
        fetch(php_file + "?filter="+ encodeURIComponent(option)).then(response => response.text()).then(data=>{

            table.innerHTML = data;

            let types = document.querySelectorAll(".type");

            types.forEach(type => {
                       
                if(type.textContent.toUpperCase() == "SALES LEAD"){
                    type.innerHTML = "SALES LEAD";
                    type.style.backgroundColor = "#DEE368";
                    type.style.padding = "7px";
                    type.style.borderRadius = "5px";
                    type.style.fontWeight = "bold";
                    
                }

                else if(type.textContent.toUpperCase()=="SUPPORT"){
                    type.innerHTML = "SUPPORT";
                    type.style.backgroundColor = "#A98EE8";
                    type.style.padding = "7px";
                    type.style.borderRadius = "5px";
                    type.style.color = "black";
                    type.style.fontWeight = "bold";
                }
            });

        }).catch(error =>{
            alert(error);
        });
    }

    function newContact(){
        window.location.href = "add_contact.php";
    }


    button.addEventListener("click", newContact);


    function resetStyle(click){
        if(click == "All"){
            sale.style.color = 'black';
            sale.style.textDecoration ='none';
            support.style.color = 'black';
            support.style.textDecoration ='none';
            assigned.style.color = 'black';
            assigned.style.textDecoration ='none';
        }
        else if(click == "Sales"){
            gen.style.color = 'black';
            gen.style.textDecoration ='none';
            support.style.color = 'black';
            support.style.textDecoration ='none';
            assigned.style.color = 'black';
            assigned.style.textDecoration ='none';
        }

        else if(click == "Support"){
            gen.style.color = 'black';
            gen.style.textDecoration ='none';
            sale.style.color = 'black';
            sale.style.textDecoration ='none';
            assigned.style.color = 'black';
            assigned.style.textDecoration ='none';
        }

        else if(click == "Assigned"){
            gen.style.color = 'black';
            gen.style.textDecoration ='none';
            support.style.color = 'black';
            support.style.textDecoration ='none';
            sale.style.color = 'black';
            sale.style.textDecoration ='none';
        }

    }

    gen.addEventListener("click", e=>{
        filterTable('');
        gen.style.color= 'skyblue';
        gen.style.textDecoration ='underline';
        resetStyle("All");
        
    });

    sale.addEventListener("click", e=>{
        filterTable('Sales');
        sale.style.color = 'skyblue';
        sale.style.textDecoration ='underline';
        resetStyle("Sales");
    });

    support.addEventListener("click", e=>{
        filterTable('Support');
        support.style.color = 'skyblue';
        support.style.textDecoration ='underline';
        resetStyle("Support");
    });

    assigned.addEventListener("click", e=>{
        filterTable('Assigned');
        assigned.style.color = 'skyblue';
        assigned.style.textDecoration = 'underline';
        resetStyle("Assigned");
    });

    filterTable('');
    gen.style.color= 'skyblue';
    gen.style.textDecoration ='underline';


});
