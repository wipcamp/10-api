pipeline {
  agent any
  environment {
    GIT_BRANCH = "${BRANCH_NAME}"
  }
  stages {
    stage('install-dependencies') {
      steps {
        sh 'sudo docker container run -v "$(pwd):/app" --rm composer:1.6.3 install'
        sh 'sudo docker container run -v "$(pwd):/app" --rm composer:1.6.3 dump-autoload'
      }
    }
    stage('build-image') {
      steps {
        sh 'sudo docker build . -t wip-api'
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api'
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api:$GIT_BRANCH'
      }
    }
    stage('push-image') {
      steps {
        sh 'sudo docker push registry.wip.camp/wip-api:$GIT_BRANCH'
        sh 'sudo docker push registry.wip.camp/wip-api'
      }
    }
    stage('versioning') {
      when {
        expression {
          return GIT_BRANCH == 'master'
        }
      }
      steps {
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api:$GIT_BRANCH-$BUILD_NUMBER'
        sh 'sudo docker push registry.wip.camp/wip-api:$GIT_BRANCH-$BUILD_NUMBER'
        sh 'sudo docker image rm registry.wip.camp/wip-api:$GIT_BRANCH-$BUILD_NUMBER'
      }
    }
    stage('clean') {
      steps {
        sh 'sudo docker image rm registry.wip.camp/wip-api:$GIT_BRANCH'
        sh 'sudo docker image rm registry.wip.camp/wip-api'
        sh 'sudo docker image rm wip-api'
      }
    }
    stage('deploy-development') {
      when {
        expression {
          branch = sh(returnStdout: true, script: 'echo $GIT_BRANCH').trim()
          return branch == 'develop'
        }
      }
      steps {
        sh 'sudo kubectl rolling-update wip-api -n development --image registry.wip.camp/wip-api:$GIT_BRANCH --container wip-api-app'
      }
    }
  }
  post {
    success {
      sh 'echo success'
    }
    failure {
      sh 'echo failure'
    }
  }
}