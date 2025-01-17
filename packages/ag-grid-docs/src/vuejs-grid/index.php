<?php
$pageTitle = "Vue Grid";
$pageDescription = "ag-Grid is a feature-rich Vue grid available in Free or Enterprise versions. This page details how to get started using ag-Grid inside an Vue application.";
$pageKeyboards = "Vue Grid";
$pageGroup = "basics";
include '../documentation-main/documentation_header.php';
?>
<script src="../_assets/js/copy-code.js"></script>
<style><?php include '../_assets//pages/get-started.css'; ?></style>

<h1>Vue Grid | Get Started with ag-Grid and Vue</h1>

<p class="lead" id="vue-grid-description">
    ag-Grid is the industry standard for Vue Enterprise Applications. Developers using ag-Grid
    are building applications that would not be possible if ag-Grid did not exist.
</p>

<?php
include './intro.php';
?>

<h2>Getting Started</h2>

<p>
    In this article, we will walk you through the necessary steps to add ag-Grid
    (both <a href="../javascript-grid-set-license/">Community and Enterprise</a> are covered)
    to an existing Vue project, configure some of the essential features of it.
    We will show you some of the fundamentals of the grid (passing properties, using the API, etc).
    As a bonus, we will also tweak the grid's visual appearance using Sass variables.
</p>

<h2>Add ag-Grid to Your Project</h2>

<p>For the purposes of this tutorial, we are going to scaffold an Vue app with <a href="https://cli.vuejs.org/">Vue CLI</a>.
Don't worry if your project has a different configuration. Ag-Grid and its Vue wrapper are distributed as NPM packages, which should work with any common Vue project module bundler setup. 
Let's follow the <a href="https://cli.vuejs.org/">Vue CLI instructions</a> - run the following in your terminal:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)" id="install-ag-vuejs">Copy Code</button>
<snippet language="sh">
npm install -g @vue/cli
vue create my-project
</snippet>
</section>
<p>When prompted choose "Manually select features":</p>

<img class="img-fluid" src="./cli-step1.png" alt="Manually Select Features" />

<p>Next, select <code>Babel</code> and <code>CSS Pre-processors</code> (we've also deselected <code>Linter</code> here, but
this is optional):</p>

<img class="img-fluid" src="./cli-step2.png" alt="Select Features" />

<p>Next select <code>SASS/SCSS</code> as the CSS Pre-processor:</p>

<img class="img-fluid" src="./cli-step3.png" alt="CSS Pre-processor" />

<p>Finally choose where to store the configuration data - we've opted for <code>dedicated config files</code>:</p>

<img class="img-fluid" src="./cli-step4.png" alt="Config files" />

<p>We're not ready to start our application:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="sh">
cd my-project
npm run serve
</snippet>
</section>

<p>If everything goes well, <code>npm run serve</code> has started the web server. You can open the default app at <a href="http://localhost:8080" target="_blank">localhost:8080</a>.</p>

<p>As a next step, let's add the ag-Grid NPM packages. run the following command in <code>my-project</code> (you may need a new instance of the terminal):</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="sh">
npm install --save @ag-grid-community/all-modules @ag-grid-community/vue vue-property-decorator

# or, if using Enterprise featuers
npm install --save @ag-grid-enterprise/all-modules @ag-grid-community/vue vue-property-decorator
</snippet>
</section>

<p>After a few seconds of waiting, you should be good to go. Let's get to the actual coding! As a first step, 
    let's add the ag-Grid the ag-Grid styles - import them in the style section of <code>src/App.vue</code>:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet>
&lt;style lang="scss"&gt;
  @import "../node_modules/@ag-grid-community/all-modules/dist/styles/ag-grid.css";
  @import "../node_modules/@ag-grid-community/all-modules/dist/styles/ag-theme-balham.css";

  // or, if using Enterprise featuers
  // @import "../node_modules/@ag-grid-enterprise/all-modules/dist/styles/ag-grid.css";
  // @import "../node_modules/@ag-grid-enterprise/all-modules/dist/styles/ag-theme-balham.css";
&lt;/style&gt;
</snippet>
</section>
<p>The code above imports the grid "structure" stylesheet (<code>ag-grid.css</code>), and one of the available grid themes: (<code>ag-theme-balham.css</code>). 
The grid ships several different themes; pick one that matches your project design.</p>

<div class="note">In a later section we documentation on how you can <a href="#vue_theme_look">Customise the Theme Look</a> using SCSS, which is our recommended approach.</div>

<p>As this will be a simple example we can delete the <code>src/components</code> directory. Our example application will live in <code>src/App.vue</code>.</p>

<p>Let's add the component definition to our template. Edit <code>app/App.vue</code> and replace the scaffold code:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="html">
&lt;template&gt;
    &lt;ag-grid-vue style="width: 500px; height: 500px;"
                 class="ag-theme-balham"
                 :columnDefs="columnDefs"
                 :rowData="rowData"&gt;
    &lt;/ag-grid-vue&gt;
&lt;/template&gt;
</snippet>
</section>
<p>Next, let's declare the basic grid configuration. Edit <code>src/App.vue</code>:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet>
&lt;script&gt;
    import {AgGridVue} from "@ag-grid-community/vue";

    export default {
        name: 'App',
        data() {
            return {
                columnDefs: null,
                rowData: null
            }
        },
        components: {
            AgGridVue
        },
        beforeMount() {
            this.columnDefs = [
                {headerName: 'Make', field: 'make'},
                {headerName: 'Model', field: 'model'},
                {headerName: 'Price', field: 'price'}
            ];

            this.rowData = [
                {make: 'Toyota', model: 'Celica', price: 35000},
                {make: 'Ford', model: 'Mondeo', price: 32000},
                {make: 'Porsche', model: 'Boxter', price: 72000}
            ];
        }
    }
&lt;/script&gt;
</snippet>
</section>
<p>The code above presents two essential configuration properties of the grid - <a href="https://www.ag-grid.com/javascript-grid-column-definitions/"><strong>the column definitions</strong></a> (<code>columnDefs</code>) and the data (<code>rowData</code>). In our case, the column definitions contain three columns; 
each column entry specifies the header label and the data field to be displayed in the body of the table.</p> 

<p>This is the ag-grid component definition, with two property bindings - <code>rowData</code> and <code>columnDefs</code>. The component also accepts the standard DOM <code>style</code> and <code>class</code>. 
We have set the class to <code>ag-theme-balham</code>, which defines the grid theme. 
As you may have already noticed, the CSS class matches the name of CSS file we imported earlier.
</p>

<p>Finally, note that we've imported the <code>@ag-grid-community/vue</code> component - this is actual component that will provide the ag-Grid functionality.</p>

<p>If everything works as expected, you should see a simple grid like the one on the screenshot:</p> 

<img class="img-fluid" src="../getting-started/step1.png" alt="ag-Grid hello world" />

<h2>Enable Sorting And Filtering</h2>

<p>So far, so good. But wouldn't it be nice to be able to sort the data to
    help us see which car is the least/most expensive? Well, enabling sorting
    in ag-Grid is actually quite simple - all you need to do is set
    the <code>sortable</code> property to the column definitions.</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="js">
this.columnDefs = [
    {headerName: 'Make', field: 'make', sortable: true },
    {headerName: 'Model', field: 'model', sortable: true },
    {headerName: 'Price', field: 'price', sortable: true }
];
</snippet>
</section>
<p>After adding the property, you should be able to sort the grid by clicking on the column headers. Clicking on a header toggles through ascending, descending and no-sort.</p>

<p>Our application doesn't have too many rows, so it's fairly easy to find data. But it's easy to imagine how a real-world application may have hundreds (or even hundreds of thousands!) or rows, with many columns. In a data set like this <a href="https://www.ag-grid.com/javascript-grid-filtering/">filtering</a> is your friend.</p>

<p>As with sorting, enabling filtering is as easy as setting the <code>filter</code> property:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="js">
this.columnDefs = [
    {headerName: 'Make', field: 'make', sortable: true, filter: true },
    {headerName: 'Model', field: 'model', sortable: true, filter: true },
    {headerName: 'Price', field: 'price', sortable: true, filter: true }
];
</snippet>
</section>
<p>With this property set, the grid will display a small column menu icon when you hover the header. Pressing it will display a popup with filtering UI which lets you choose the kind of filter and the text that you want to filter by.</p>

<img class="img-fluid" src="../getting-started/step2.png" alt="ag-Grid sorting and filtering" />

<h2>Fetch Remote Data</h2>

<p>Displaying hard-coded data in JavaScript is not going to get us very far. In the real world, most of the time, we are dealing with data that resides on a remote server. Thanks to React, implementing this is actually quite simple.
    Notice that the actual data fetching is performed outside of the grid component - We are using the HTML5 <code>fetch</code> API.</p>

<p>Now, let's remove the hard-coded data and fetch one from a remote server. Edit the <code>src/App.vue</code> and add the following fetch statement: </p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet>
beforeMount() {
    this.columnDefs = [
        {headerName: 'Make', field: 'make'},
        {headerName: 'Model', field: 'model'},
        {headerName: 'Price', field: 'price'}
    ];

    fetch('https://api.myjson.com/bins/15psn9')
        .then(result =&gt; result.json())
        .then(rowData =&gt; this.rowData = rowData);
}
</snippet>
</section>
<p>The remote data is the same as the one we initially had, so you should not notice any actual changes to the grid. However, you will see an additional HTTP request performed if you open your developer tools.</p>


<h2>Enable Selection</h2> 

<p>Being a programmer is a hectic job. Just when we thought that we are done with our assignment, the manager shows up with a fresh set of requirements! 
It turned out that we need to allow the user to select certain rows from the grid and to mark them as flagged in the system. 
We will leave the flag toggle state and persistence to the backend team. On our side, we should enable the selection and, afterwards, to obtain the selected records and pass them with an API call to a remote service endpoint.</p> 

<p>Fortunately, the above task is quite simple with ag-Grid. As you may have already guessed, it is just a matter of adding and changing couple of properties.</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="html">
&lt;template&gt;
    &lt;ag-grid-vue style="width: 500px; height: 500px;"
                 class="ag-theme-balham"
                 :columnDefs="columnDefs"
                 :rowData="rowData"
                 rowSelection="multiple"&gt;
    &lt;/ag-grid-vue&gt;
&lt;/template&gt;

&lt;script&gt;
    import {AgGridVue} from "@ag-grid-community/vue";

    export default {
        name: 'App',
        data() {
            return {
                columnDefs: null,
                rowData: null
            }
        },
        components: {
            AgGridVue
        },
        beforeMount() {
            this.columnDefs = [
                {headerName: 'Make', field: 'make', checkboxSelection: true},
                {headerName: 'Model', field: 'model'},
                {headerName: 'Price', field: 'price'}
            ];

            fetch('https://api.myjson.com/bins/15psn9')
                .then(result =&gt; result.json())
                .then(rowData =&gt; this.rowData = rowData);
        }
    }
&lt;/script&gt;

&lt;style&gt;
&lt;/style&gt;
</snippet>
</section>
<p>Next, let's enable <a href="https://www.ag-grid.com/javascript-grid-selection/#multi-row-selection">multiple row selection</a>, so that the user can pick many rows:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="html">
&lt;ag-grid-vue style="width: 500px; height: 500px;"
             class="ag-theme-balham"
             :columnDefs="columnDefs"
             :rowData="rowData"

             rowSelection="multiple"&gt;
&lt;/ag-grid-vue&gt;
</snippet>
</section>
<p>We've added a checkbox to the <code>make</code> column with <code>checkboxSelection: true</code> and then enabled multiple row selection with <code>rowSelection="multiple"</code>.</p>

<div class="note">We took a bit of a shortcut here, by not binding the property value. Without <code>[]</code>, the assignment will pass the attribute value as a string, which is fine for our purposes.</div>

<p>Great! Now the first column contains a checkbox that, when clicked, selects the row. The only thing we have to add is a button that gets the selected data and sends it to the server. To do this, we are
    going to use the <a href="https://www.ag-grid.com/javascript-grid-api/">ag-Grid API</a> - we will store a reference to both the grid and column API's in the <code>gridReady</code> event</p>

<p>To test this we'll add a button that gets the selected data and sends it to the server. Let's go ahead and make these changes:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="html">
&lt;template&gt;
    &lt;div&gt;
        &lt;button @click="getSelectedRows()"&gt;Get Selected Rows&lt;/button&gt;

        &lt;ag-grid-vue style="width: 500px; height: 500px;"
                     class="ag-theme-balham"
                     :columnDefs="columnDefs"
                     :rowData="rowData"
                     rowSelection="multiple"

                     @grid-ready="onGridReady"&gt;
        &lt;/ag-grid-vue&gt;
    &lt;/div&gt;
&lt;/template&gt;

&lt;script&gt;
    import {AgGridVue} from "@ag-grid-community/vue";

    export default {
        name: 'App',
        data() {
            return {
                columnDefs: null,
                rowData: null
            }
        },
        components: {
            AgGridVue
        },
        methods: {
            onGridReady(params) {
                this.gridApi = params.api;
                this.columnApi = params.columnApi;
            },
            getSelectedRows() {
                const selectedNodes = this.gridApi.getSelectedNodes();
                const selectedData = selectedNodes.map( node =&gt; node.data );
                const selectedDataStringPresentation = selectedData.map( node =&gt; node.make + ' ' + node.model).join(', ');
                alert(`Selected nodes: ${selectedDataStringPresentation}`);
            }
        },
        beforeMount() {
            this.columnDefs = [
                {headerName: 'Make', field: 'make', checkboxSelection: true},
                {headerName: 'Model', field: 'model'},
                {headerName: 'Price', field: 'price'}
            ];

            fetch('https://api.myjson.com/bins/15psn9')
                .then(result =&gt; result.json())
                .then(rowData =&gt; this.rowData = rowData);
        }
    }
&lt;/script&gt;

&lt;style&gt;
&lt;/style&gt;
</snippet>
</section>
<p>Well, we cheated a bit. Calling <code>alert</code> is not exactly a call to our backend.
Hopefully you will forgive us this shortcut for the sake of keeping the article short and simple. Of course, you can substitute that bit with a real-world application logic after you are done with the tutorial.</p> 

<h2>Grouping</h2>

<div class="note">
    Grouping is a feature exclusive to ag-Grid Enterprise. You are free to trial ag-Grid Enterprise to see what you
    think. You only need to get in touch if you want to start using ag-Grid Enterprise in a project intended
    for production.
</div>

<p>In addition to filtering and sorting, <a href="https://www.ag-grid.com/javascript-grid-grouping/">grouping</a> is another
    effective way for the user to make sense out of large amounts of data. In our case, the data is not that much.
    Let's switch to a slightly larger data set:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="diff">
beforeMount() {
    this.columnDefs = [
        {headerName: 'Make', field: 'make', checkboxSelection: true},
        {headerName: 'Model', field: 'model'},
        {headerName: 'Price', field: 'price'}
    ];

-    fetch('https://api.myjson.com/bins/15psn9')
-        .then(result => result.json())
-        .then(rowData => this.rowData = rowData);
+    fetch('https://api.myjson.com/bins/ly7d1')
+        .then(result => result.json())
+        .then(rowData => this.rowData = rowData);
}
</snippet>
</section>

<img class="img-fluid" src="../getting-started/step3.png" alt="ag-Grid final" />

<p>Now, let's enable grouping! Add an <code>autoGroupColumnDef</code> property, bind to it, and update the <code>columnDefs</code> with a <code>rowGroup</code>:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="html">
&lt;template&gt;
    &lt;div&gt;
        &lt;button @click="getSelectedRows()"&gt;Get Selected Rows&lt;/button&gt;
        &lt;ag-grid-vue style="width: 500px; height: 500px;"
                     class="ag-theme-balham"
                     :columnDefs="columnDefs"
                     :rowData="rowData"
                     rowSelection="multiple"

                     @grid-ready="onGridReady"&gt;
        &lt;/ag-grid-vue&gt;
    &lt;/div&gt;
&lt;/template&gt;

&lt;script&gt;
    import {AgGridVue} from "@ag-grid-community/vue";

    export default {
        name: 'App',
        data() {
            return {
                columnDefs: null,
                rowData: null,
                gridApi: null,
                columnApi: null,
                autoGroupColumnDef: null
            }
        },
        components: {
            AgGridVue
        },
        methods: {
            onGridReady(params) {
                this.gridApi = params.api;
                this.columnApi = params.columnApi;
            },
            getSelectedRows() {
                const selectedNodes = this.gridApi.getSelectedNodes();
                const selectedData = selectedNodes.map(node =&gt; node.data);
                const selectedDataStringPresentation = selectedData.map(node =&gt; node.make + ' ' + node.model).join(', ');
                alert(`Selected nodes: ${selectedDataStringPresentation}`);
            }
        },
        beforeMount() {
            this.columnDefs = [
                {headerName: 'Make', field: 'make', rowGroup: true},
                {headerName: 'Model', field: 'model'},
                {headerName: 'Price', field: 'price'}
            ];

            this.autoGroupColumnDef = {
                headerName: 'Model',
                field: 'model',
                cellRenderer: 'agGroupCellRenderer',
                cellRendererParams: {
                    checkbox: true
                }
            };

            fetch('https://api.myjson.com/bins/15psn9')
                .then(result =&gt; result.json())
                .then(rowData =&gt; this.rowData = rowData);
        }
    }
&lt;/script&gt;

&lt;style&gt;
&lt;/style&gt;
</snippet>
</section>
<p>There we go! The grid now groups the data by <code>make</code>, while listing the <code>model</code> field value when expanded.
Notice that grouping works with checkboxes as well - the <code>groupSelectsChildren</code> property adds a group-level checkbox that selects/deselects all items in the group.</p>

<div class="note"> Don't worry if this step feels a bit overwhelming - the  grouping feature is very powerful and supports complex interaction scenarios which you might not need initially. 
The grouping documentation section contains plenty of real-world runnable examples that can get you started for your particular  case.</div>

<h2 id="vue_theme_look">Customize the Theme Look</h2>

<p>The last thing which we are going to do is to change the grid look and feel by modifying some of the theme's Sass variables.</p> 

<p>By default, ag-Grid ships a set of <a href="https://www.ag-grid.com/javascript-grid-styling/">pre-built theme stylesheets</a>. If we want to tweak the colors and the fonts of theme, we should add a Sass preprocessor to our project, 
override the theme variable values, and refer the ag-grid Sass files instead of the pre-built stylesheets so that the variable overrides are applied.</p>

<p>The <code>vue cli</code> did a lot of for us including providing support for Sass. Let's switch to using the provided 
ag-Grid SCSS files - replace the <code>style</code> block in <code>src/App.vue</code> with:</p>
<section>
<button class="btn copy-code-button" onclick="copyCode(event)">Copy Code</button>
<snippet language="scss">
&lt;style lang="scss"&gt;
  @import "../node_modules/@ag-grid-community/all-modules/src/styles/ag-grid.scss";
  @import "../node_modules/@ag-grid-community/all-modules/src/styles/ag-theme-balham/sass/ag-theme-balham.scss";

// or, if using Enterprise features
//  @import "../node_modules/@ag-grid-community/all-modules/src/styles/ag-grid.scss";
//  @import "../node_modules/@ag-grid-community/all-modules/src/styles/ag-theme-balham/sass/ag-theme-balham.scss";
&lt;/style&gt;
</snippet>
</section>
<p>If everything is configured correctly, the second row of the grid will get slightly darker. Congratulations!
You now know now bend the grid look to your will - there are a few dozens more Sass variables that let you control the font family and size, border color, 
header background color and even the amount of spacing in the cells and columns. The full <a href="https://www.ag-grid.com/javascript-grid-styling/#customizing-sass-variables">Sass variable list</a> is available in the themes documentation section.</p> 

<h2>Summary</h2> 

<p>With this tutorial, we managed to accomplish a lot. Starting from the humble beginnings of a three row / column setup, we now have a grid that supports sorting, filtering, binding to remote data, selection and even grouping! 
While doing so, we learned how to configure the grid, how to access its API object, and how to change the styling of the component.</p> 

<?php include '../documentation-main/documentation_footer.php'; ?>
