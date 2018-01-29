pipeline {
  agent any
  environment {
    GIT_BRANCH = "${BRANCH_NAME}"
  }
  stages {
    stage('initial') {
      steps {
        sh 'composer install'
        sh 'composer dump-autoload'
      }
    }
    stage('test') {
      steps {
        sh 'echo no test now test trigger'
        sh 'echo $GIT_BRANCH'
      }
    }
    stage('build') {
      when {
        expression {
          branch = sh(returnStdout: true, script: 'echo $GIT_BRANCH').trim()
          return branch == 'develop' || branch == 'master'
        }
      }
      steps {
        sh 'sudo docker build . -t wip-api'
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api:$GIT_BRANCH-$BUILD_NUMBER'
        sh 'sudo docker tag wip-api registry.wip.camp/wip-api'
      }
    }
    stage('push') {
      when {
        expression {
          branch = sh(returnStdout: true, script: 'echo $GIT_BRANCH').trim()
          return branch == 'develop' || branch == 'master'
        }
      }
      steps {
        sh 'sudo docker push registry.wip.camp/wip-api:$GIT_BRANCH-$BUILD_NUMBER'
        sh 'sudo docker push registry.wip.camp/wip-api'
      }
    }
    stage('clean') {
      when {
        expression {
          branch = sh(returnStdout: true, script: 'echo $GIT_BRANCH').trim()
          return branch == 'develop' || branch == 'master'
        }
      }
      steps {
        sh 'sudo docker image rm registry.wip.camp/wip-api:$GIT_BRANCH-$BUILD_NUMBER'
        sh 'sudo docker image rm registry.wip.camp/wip-api'
      }
    }
    stage('deploy-development') {
      when {
        expression {
          branch = sh(returnStdout: true, script: 'echo $GIT_BRANCH').trim()
          return branch == 'develop' || branch == 'master'
        }
      }
      steps {
        sh 'sudo kubectl rolling-update wip-api -n development --image registry.wip.camp/wip-api:$GIT_BRANCH-$BUILD_NUMBER --container wip-api-app'
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