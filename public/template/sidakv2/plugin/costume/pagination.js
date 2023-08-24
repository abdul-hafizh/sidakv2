export default class paginate {
     
      fetchData(page){

           const content = $('#content');
             content.empty();
          
            let row = ``;
                row +=`<tr><td colspan="8" align="center"> <b>Loading ...</b></td></tr>`;
                content.append(row);

          $.ajax({
              url: BASE_URL+ `/api/user?page=${page}&per_page=${itemsPerPage}`,
              method: 'GET',
              success: function(response) {
                list = response.data;
                  // Update content area with fetched data
                  updateContent(response.data);

                  // Update pagination controls
                  const pageview = new paginate();
                  var currentNext = pageview.views(response.current_page, response.last_page);
                  fetchData(currentNext);
                 // updatePagination(response.current_page, response.last_page);
              },
              error: function(error) {
                  console.error('Error fetching data:', error);
              }
          });
      }


  
      views(currentPage, totalPages)
      {
          const pagination = $('#pagination');
          const visiblePages = 5;
          // Clear previous pagination
          pagination.empty();

          // Calculate start and end page for visible links
          let startPage = Math.max(1, currentPage - Math.floor(visiblePages / 2));
          let endPage = Math.min(totalPages, startPage + visiblePages - 1);

          //Create "First Page" button
          if (currentPage > 1) {
              pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="1">«</button></li>`);

          }else{
             pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable">«</button></li>`);
          }

           // Create "Back" button
          if (currentPage > 1) {
              pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage - 1}">‹</button></li>`);
          }else{
            //back disable
            pagination.append(`<li class="pagination-item "><button class="pagination-link pagination-disable" >‹</button></li>`);
          }

          // Create pagination links
          for (let i = startPage; i <= endPage; i++) {
              pagination.append(`<li class="pagination-item"><button class="pagination-link page-link${i === currentPage ? ' pagination-link--active' : ''}" data-page="${i}">${i}</button></li>`);
          }

            // Create "Next" button
          if (currentPage < totalPages) {
              pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${currentPage + 1}">›</button></li>`);
          }else{
            pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >›</button></li>`);
          }

           // Create "Last Page" button
          if (currentPage < totalPages) {
              pagination.append(`<li class="pagination-item"><button class="pagination-link page-link" data-page="${totalPages}">»</button></li>`);

          }else{
              pagination.append(`<li class="pagination-item"><button class="pagination-link pagination-disable" >»</button></li>`);
          }



          // Add click event to pagination links
          pagination.find('.page-link').on('click', function() {
              currentPage = parseInt($(this).data('page'));
               const content = $('#content');
               content.empty();
               return currentPage;
             // fetchData(currentPage);
          });

      }


      
}