module.exports = function(grunt){
    /**************************
     *  configuaration des modules
     *  ***********************/
    grunt.initConfig({
        symlink: {
            app: {
                dest: 'web/bundles/app',
                relativeSrc: '../../app/Resources/public/',
                options: {type: 'dir'} // 'file' by default
            }
        },
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'web/built/app/css/taxi.min.css': ['app/Resources/public/css/override.css', 'app/Resources/public/css/custom.css']
                }
            }
        },
        watch:{
            options:{
                livereload: true
            },
            css:{
                files:'web/bundles/*/css/*.css',
                tasks: ['cssmin']

            }
        }

    });

    /**************************
     *  chargement des module grunt
     *  ***********************/
    grunt.loadNpmTasks("grunt-symlink");
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');
    /**************************
     *  declaration des task pour
     *  la ligne de commande
     *  ***********************/

    grunt.registerTask("default",['symlink','cssmin']);

};
