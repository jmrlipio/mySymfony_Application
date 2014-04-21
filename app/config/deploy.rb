set :application, "SymfonyApp"
set :domain,      "hextechlabs.net"
set :user,        "hextechl"
set :use_sudo,    false
set :deploy_to,   "jone/mySymfony_prod"
set :app_path,    "app"     
set :web_path,    "web"

set :repository,    "file://opt/lampp/htdocs/projects/"
set :deploy_via,  :copy
set :scm,         :git
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,   [app_path + "/logs", web_path + "/uploads", "vendor"]

set :use_composer,  true
set :upload_vendors, true

set  :keep_releases,  3
set :deploy_via, :remote_cache

task :upload_parameters do
  origin_file = "app/config/parameters.yml"
  destination_file = shared_path + "/app/config/parameters.yml" # Notice the
  shared_path

  try_sudo "mkdir -p #{File.dirname(destination_file)}"
  top.upload(origin_file, destination_file)
end

# Be more verbose by uncommenting the following line
 logger.level = Logger::MAX_LEVEL
 
