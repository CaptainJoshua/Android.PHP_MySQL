package com.example.myandroidphpmysql;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

public class ProfileActivity extends AppCompatActivity {
//    14 - User Profile Activity
    private TextView textViewEmail, textViewUsername;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_profile);

        if (!SharedPrefManager.getInstance(this).isLoggedIn()) {
            finish();
           Intent intent = new Intent(getApplicationContext(), LoginActivity.class);
           startActivity(intent);
        }

        textViewEmail = findViewById(R.id.textViewEmail);
        textViewUsername = findViewById(R.id.textViewUsername);

        textViewEmail.setText(SharedPrefManager.getInstance(this).getEmail());
        textViewUsername.setText(SharedPrefManager.getInstance(this).getUsername());
    }

//    15 - User Logout Option
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.menu, menu);
        return true;
    }

    // Items inside the menu located in the upper right part of the app
    @Override
    public boolean onOptionsItemSelected(@NonNull MenuItem item) {
      switch (item.getItemId()) {

          case R.id.menuSettings:
              Toast.makeText(getApplicationContext(), "You click settings", Toast.LENGTH_LONG).show();
                break;

                // When clicked, it will redirect to register.
          case R.id.menuLogout:
              SharedPrefManager.getInstance(this).logout();
              finish();
              Intent intent = new Intent(getApplicationContext(), MainActivity.class);
              startActivity(intent);
              break;
      }
        return true;
    }
}